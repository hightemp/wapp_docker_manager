import { tpl, fnAlertMessage } from "./lib.js"

export class DockerContainers {
    static sURL = ``

    static _oSelected = null;
    static _oSelectedGroup = null;
    
    static oURLs = {
        create: 'ajax.php?method=create_docker_container',
        update: tpl`ajax.php?method=update_docker_container&id=${0}`,
        delete: 'ajax.php?method=delete_docker_container',
        list: `ajax.php?method=list_docker_containers`,

        update_list: `ajax.php?method=update_list_containers`,
    }
    static oWindowTitles = {
        create: 'Новый',
        update: 'Редактировать'
    }
    static oEvents = {
        docker_containers_save: "docker_containers:save",
        docker_containers_select: "docker_containers:select",
    }

    static get oDialog() {
        return $('#docker_containers-dlg');
    }
    static get oDialogForm() {
        return $('#docker_containers-dlg-fm');
    }
    static get oComponent() {
        return $("#docker_containers-datagrid");
    }
    static get oContextMenu() {
        return $("#docker_containers-mm");
    }

    static get oEditDialogCategoryCleanBtn() {
        return $('#docker_containers-docker_container-clean-btn');
    }
    static get oEditDialogSaveBtn() {
        return $('#docker_containers-dlg-save-btn');
    }
    static get oEditDialogCancelBtn() {
        return $('#docker_containers-dlg-cancel-btn');
    }

    static get oPanelTableReloadButton() {
        return $('#docker_containers-table-reload-btn');
    }
    static get oPanelReloadButton() {
        return $('#docker_containers-reload-btn');
    }

    static get fnComponent() {
        return this.oComponent.datagrid.bind(this.oComponent);
    }

    static get oSelectedCategory() {
        return this._oSelected;
    }

    static fnShowDialog(sTitle) {
        this.oDialog.dialog('open').dialog('center').dialog('setTitle', sTitle);
    }
    static fnDialogFormLoad(oRows={}) {
        this.oDialogForm.form('clear');
        this.oDialogForm.form('load', oRows);
    }

    static fnShowCreateWindow() {
        if (!this._oSelectedGroup) {
            return;
        }
        this.sURL = this.oURLs.create;
        var oData = {
            group_id: this._oSelectedGroup.id,
            docker_container_id: this._oSelected ? this._oSelected.id : null,
        }
        this.fnShowDialog(this.oWindowTitles.create);
        this.fnDialogFormLoad(oData);

        this.oCategoryTreeList.combotree(
            'reload', 
            this.oURLs.list_tree_docker_containers(this._oSelectedGroup.id)
        );
    }

    static fnShowEditWindow(oRow) {
        if (oRow) {
            this.sURL = this.oURLs.update(oRow.id);
            this.fnShowDialog(this.oWindowTitles.update);
            this.fnDialogFormLoad(oRow);
        }
    }

    static fnTableReload() {
        $.post(
            this.oURLs.update_list,
            {  },
            (function(result) {
                this.fnReload();
            }).bind(this),
            'json'
        );
    }

    static fnReload() {
        this.fnComponent('reload');
    }

    static fnSave() {
        this.oDialogForm.form('submit', {
            url: this.sURL,
            iframe: false,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: (function(result){
                this.oDialog.dialog('close');
                this.fnReload();
                this.fnReloadLists();

                this.fnFireEvent_Save();
            }).bind(this)
        });
    }

    static fnDelete(oRow) {
        if (oRow){
            $.messager.confirm(
                'Confirm',
                'Удалить?',
                (function(r) {
                    if (r) {
                        $.post(
                            this.oURLs.delete,
                            { id: oRow.id },
                            (function(result) {
                                this.fnReload();
                            }).bind(this),
                            'json'
                        );
                    }
                }).bind(this)
            );
        }
    }

    static fnMoveToRoot(oRow) {
        if (oRow){
            $.post(
                this.oURLs.move_to_root_docker_container,
                { id: oRow.id },
                (function(result) {
                    this.fnReload();
                    this.fnReloadLists();
                }).bind(this),
                'json'
            );
        }
    }

    static fnGetSelected() {
        return this.fnComponent('getSelected');
    }

    static fnSelect(oTarget) {
        this.fnComponent('select', oTarget);
    }

    static fnReloadLists() {
        this.oGroupList.combobox('reload');
        this.oCategoryTreeList.combotree('reload');
    }

    static fnBindEvents()
    {
        $(document).on(this.oEvents.links_save, ((oEvent, oNode) => {
            this.fnReload();
        }).bind(this))

        $(document).on(this.oEvents.groups_select, ((oEvent, oNode) => {
            this._oSelectedGroup = oNode;
            this.fnInitComponent();
        }).bind(this))

        $(document).on(this.oEvents.groups_save, ((oEvent, oNode) => {
            this.fnReloadLists();
        }).bind(this))

        $(document).on(this.oEvents.docker_containers_select, ((oEvent, oNode) => {
            this._oSelected = oNode;
            this.fnReloadLists();
        }).bind(this))

        this.oEditDialogCategoryCleanBtn.click((() => {
            this.oCategoryTreeList.combotree('clear');
        }).bind(this))
        this.oEditDialogSaveBtn.click((() => {
            this.fnSave();
        }).bind(this))
        this.oEditDialogCancelBtn.click((() => {
            this.oDialog.dialog('close');
        }).bind(this))

        this.oPanelTableReloadButton.click((() => {
            this.fnTableReload();
        }).bind(this))
        this.oPanelReloadButton.click((() => {
            this.fnReload();
        }).bind(this))
    }

    static fnFireEvent_Save() {
        $(document).trigger(this.oEvents.docker_containers_save);
    }

    static fnFireEvent_Select(oNode) {
        $(document).trigger(this.oEvents.docker_containers_select, [oNode])
    }

    static fnFireEvent_LinksAdd() {
        $(document).trigger(this.oEvents.links_add);
    }

    static fnInitComponent()
    {
        this.fnComponent({
            singleSelect: true,
            url: this.oURLs.list,
            method:'get',

            fit: true,
            border: false,

            nowrap: false,

            toolbar: '#docker_containers-tt',

            idField:'Id',
            treeField:'Id',
            columns:[[
                {
                    title:'Id',field:'Id',width:400,
                },
                {
                    title:'Image',field:'Image',width:200,
                },
                {
                    title:'Command',field:'Command',width:200,
                },
                {
                    title:'State',field:'State',width:100,
                },
                {
                    title:'Status',field:'Status',width:100,
                },
                {
                    title:'Ports',field:'Ports',width:200,
                    formatter: function(value,row,index) {
                        var sS = ``;

                        for (var oPort of row.Ports) {
                            sS += `<div>${oPort.PrivatePort} -> ${oPort.Type ?? ''}://${oPort.IP ?? ''}:${oPort.PublicPort ?? ''}</div>`
                        }

                        return sS;
                    }
                },

            ]],

            onSelect: ((oNode) => {
                this._oSelected = oNode;
                this.fnFireEvent_Select(oNode);
            }).bind(this),

            onContextMenu: (function(e, node) {
                e.preventDefault();
                this.fnSelect(node.target);
                this.oContextMenu.menu('show', {
                    left: e.pageX,
                    top: e.pageY,
                    onClick: ((item) => {
                        if (item.id == 'add') {
                            this.fnShowCreateWindow();
                        }
                        if (item.id == 'add_link') {
                            this.fnFireEvent_LinksAdd();
                        }
                        if (item.id == 'edit') {
                            this.fnShowEditWindow(node);
                        }
                        if (item.id == 'delete') {
                            this.fnDelete(node);
                        }
                        if (item.id == 'move_to_root_docker_container') {
                            this.fnMoveToRoot(node);
                        }
                    }).bind(this)
                });
            }).bind(this),

            rowStyler: function(index,row) {
                if (row.State == 'restarting'){
                    return 'background: rgba(250, 0, 0, 0.1)';
                }

                if (row.State == 'stopped'){
                    return 'background: rgba(250, 0, 0, 0.3)';
                }
            }
        })

        this.fnComponent('enableFilter', []);
    }

    static fnPrepare()
    {
        this.fnInitComponent()
        this.fnBindEvents();
    }
}