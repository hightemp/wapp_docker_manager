import { tpl, fnAlertMessage } from "./lib.js"

export class DockerVolumes {
    static sURL = ``

    static _oSelected = null;
    static _oSelectedGroup = null;
    
    static oURLs = {
        create: 'ajax.php?method=create_docker_volume',
        update: tpl`ajax.php?method=update_docker_volume&id=${0}`,
        delete: 'ajax.php?method=delete_docker_volume',
        list: `ajax.php?method=list_docker_volumes`,

        update_list: `ajax.php?method=update_list_volumes`,
    }
    static oWindowTitles = {
        create: 'Новый',
        update: 'Редактировать'
    }
    static oEvents = {
        docker_volumes_save: "docker_volumes:save",
        docker_volumes_select: "docker_volumes:select",
    }

    static get oDialog() {
        return $('#docker_volumes-dlg');
    }
    static get oDialogForm() {
        return $('#docker_volumes-dlg-fm');
    }
    static get oComponent() {
        return $("#docker_volumes-datagrid");
    }
    static get oContextMenu() {
        return $("#docker_volumes-mm");
    }

    static get oEditDialogCategoryCleanBtn() {
        return $('#docker_volumes-docker_volume-clean-btn');
    }
    static get oEditDialogSaveBtn() {
        return $('#docker_volumes-dlg-save-btn');
    }
    static get oEditDialogCancelBtn() {
        return $('#docker_volumes-dlg-cancel-btn');
    }

    static get oPanelTableReloadButton() {
        return $('#docker_volumes-table-reload-btn');
    }
    static get oPanelReloadButton() {
        return $('#docker_volumes-reload-btn');
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
            docker_volume_id: this._oSelected ? this._oSelected.id : null,
        }
        this.fnShowDialog(this.oWindowTitles.create);
        this.fnDialogFormLoad(oData);

        this.oCategoryTreeList.combotree(
            'reload', 
            this.oURLs.list_tree_docker_volumes(this._oSelectedGroup.id)
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
            { },
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
                this.oURLs.move_to_root_docker_volume,
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

        $(document).on(this.oEvents.docker_volumes_select, ((oEvent, oNode) => {
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
        $(document).trigger(this.oEvents.docker_volumes_save);
    }

    static fnFireEvent_Select(oNode) {
        $(document).trigger(this.oEvents.docker_volumes_select, [oNode])
    }

    static fnFireEvent_LinksAdd() {
        $(document).trigger(this.oEvents.links_add);
    }

    static fnInitComponent()
    {
        this.fnComponent({
            url: this.oURLs.list,
            method:'get',

            fit: true,
            border: false,

            nowrap: false,

            toolbar: '#docker_volumes-tt',

            idField:'id',
            treeField:'name',
            columns:[[
                {
                    title:'Name',field:'Name',width:400,
                },
                {
                    title:'CreatedAt',field:'CreatedAt',width:200,
                },
                {
                    title:'Mountpoint',field:'Mountpoint',width:200,
                },
                {
                    title:'Scope',field:'Scope',width:100,
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
                        if (item.id == 'move_to_root_docker_volume') {
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