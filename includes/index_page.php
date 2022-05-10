<div id="tt" class="easyui-tabs" style="width:100%;height:100%;">
    
    <!-- Контейнеры containers- -->
    <?php $sT = "Контейнеры" ?>
    <?php $sP = "docker_containers-" ?>
    <?php $sC = "datagrid" ?>
    <div title="<?php echo $sT; ?>" style="padding:0px;display:none;">
        <div style="width:100%;height:100%">
            <table id="<?php echo $sP; ?><?php echo $sC; ?>" class="easyui-<?php echo $sC; ?>" data-options="fit:true" style="width:100%;"></table>

            <div id="<?php echo $sP; ?>tt">
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-table_refresh', plain:true" id="<?php echo $sP; ?>table-reload-btn"></a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload',plain:true" id="<?php echo $sP; ?>reload-btn"></a>
            </div>

            <div style="position:fixed">
                <div id="<?php echo $sP; ?>dlg" class="easyui-dialog" style="width:500px" data-options="closed:true,modal:true,border:'thin',buttons:'#<?php echo $sP; ?>dlg-buttons'">
                    <form id="<?php echo $sP; ?>dlg-fm" method="post" novalidate style="margin:0;padding:5px">
                        <div style="margin-bottom:10px">
                            <label>Заголовок:</label>
                            <input name="name" class="easyui-textbox" required="true" style="width:100%">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>Описание:</label>
                            <input name="description" class="easyui-textbox" style="width:100%;height:200px" multiline="true">
                        </div>
                    </form>
                </div>
                <div id="<?php echo $sP; ?>dlg-buttons">
                    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" id="<?php echo $sP; ?>dlg-save-btn" style="width:auto">Сохранить</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id="<?php echo $sP; ?>dlg-cancel-btn" style="width:auto">Отмена</a>
                </div>

                <div id="<?php echo $sP; ?>mm" class="easyui-menu" style="width:auto;">
                    <div data-options="id:'edit'">Радактировать</div>
                    <div data-options="id:'delete'">Удалить</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Образы containers- -->
    <?php $sT = "Образы" ?>
    <?php $sP = "docker_images-" ?>
    <?php $sC = "treegrid" ?>
    <div title="<?php echo $sT; ?>" style="padding:0px;display:none;">
        <div style="width:100%;height:100%">
            <table id="<?php echo $sP; ?><?php echo $sC; ?>" class="easyui-<?php echo $sC; ?>" data-options="fit:true" style="width:100%;"></table>

            <div id="<?php echo $sP; ?>tt">
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-table_refresh', plain:true" id="<?php echo $sP; ?>table-reload-btn"></a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload',plain:true" id="<?php echo $sP; ?>reload-btn"></a>
            </div>

            <div style="position:fixed">
                <div id="<?php echo $sP; ?>dlg" class="easyui-dialog" style="width:500px" data-options="closed:true,modal:true,border:'thin',buttons:'#<?php echo $sP; ?>dlg-buttons'">
                    <form id="<?php echo $sP; ?>dlg-fm" method="post" novalidate style="margin:0;padding:5px">
                        <div style="margin-bottom:10px">
                            <label>Заголовок:</label>
                            <input name="name" class="easyui-textbox" required="true" style="width:100%">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>Описание:</label>
                            <input name="description" class="easyui-textbox" style="width:100%;height:200px" multiline="true">
                        </div>
                    </form>
                </div>
                <div id="<?php echo $sP; ?>dlg-buttons">
                    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" id="<?php echo $sP; ?>dlg-save-btn" style="width:auto">Сохранить</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id="<?php echo $sP; ?>dlg-cancel-btn" style="width:auto">Отмена</a>
                </div>

                <div id="<?php echo $sP; ?>mm" class="easyui-menu" style="width:auto;">
                    <div data-options="id:'edit'">Радактировать</div>
                    <div data-options="id:'delete'">Удалить</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Сети containers- -->
    <?php $sT = "Сети" ?>
    <?php $sP = "docker_networks-" ?>
    <?php $sC = "datagrid" ?>
    <div title="<?php echo $sT; ?>" style="padding:0px;display:none;">
        <div style="width:100%;height:100%">
            <table id="<?php echo $sP; ?><?php echo $sC; ?>" class="easyui-<?php echo $sC; ?>" data-options="fit:true" style="width:100%;"></table>

            <div id="<?php echo $sP; ?>tt">
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-table_refresh', plain:true" id="<?php echo $sP; ?>table-reload-btn"></a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload',plain:true" id="<?php echo $sP; ?>reload-btn"></a>
            </div>

            <div style="position:fixed">
                <div id="<?php echo $sP; ?>dlg" class="easyui-dialog" style="width:500px" data-options="closed:true,modal:true,border:'thin',buttons:'#<?php echo $sP; ?>dlg-buttons'">
                    <form id="<?php echo $sP; ?>dlg-fm" method="post" novalidate style="margin:0;padding:5px">
                        <div style="margin-bottom:10px">
                            <label>Заголовок:</label>
                            <input name="name" class="easyui-textbox" required="true" style="width:100%">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>Описание:</label>
                            <input name="description" class="easyui-textbox" style="width:100%;height:200px" multiline="true">
                        </div>
                    </form>
                </div>
                <div id="<?php echo $sP; ?>dlg-buttons">
                    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" id="<?php echo $sP; ?>dlg-save-btn" style="width:auto">Сохранить</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id="<?php echo $sP; ?>dlg-cancel-btn" style="width:auto">Отмена</a>
                </div>

                <div id="<?php echo $sP; ?>mm" class="easyui-menu" style="width:auto;">
                    <div data-options="id:'edit'">Радактировать</div>
                    <div data-options="id:'delete'">Удалить</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Диски containers- -->
    <?php $sT = "Диски" ?>
    <?php $sP = "docker_volumes-" ?>
    <?php $sC = "datagrid" ?>
    <div title="<?php echo $sT; ?>" style="padding:0px;display:none;">
        <div style="width:100%;height:100%">
            <table id="<?php echo $sP; ?><?php echo $sC; ?>" class="easyui-<?php echo $sC; ?>" data-options="fit:true" style="width:100%;"></table>

            <div id="<?php echo $sP; ?>tt">
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-table_refresh', plain:true" id="<?php echo $sP; ?>table-reload-btn"></a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload',plain:true" id="<?php echo $sP; ?>reload-btn"></a>
            </div>

            <div style="position:fixed">
                <div id="<?php echo $sP; ?>dlg" class="easyui-dialog" style="width:500px" data-options="closed:true,modal:true,border:'thin',buttons:'#<?php echo $sP; ?>dlg-buttons'">
                    <form id="<?php echo $sP; ?>dlg-fm" method="post" novalidate style="margin:0;padding:5px">
                        <div style="margin-bottom:10px">
                            <label>Заголовок:</label>
                            <input name="name" class="easyui-textbox" required="true" style="width:100%">
                        </div>
                        <div style="margin-bottom:10px">
                            <label>Описание:</label>
                            <input name="description" class="easyui-textbox" style="width:100%;height:200px" multiline="true">
                        </div>
                    </form>
                </div>
                <div id="<?php echo $sP; ?>dlg-buttons">
                    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" id="<?php echo $sP; ?>dlg-save-btn" style="width:auto">Сохранить</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id="<?php echo $sP; ?>dlg-cancel-btn" style="width:auto">Отмена</a>
                </div>

                <div id="<?php echo $sP; ?>mm" class="easyui-menu" style="width:auto;">
                    <div data-options="id:'edit'">Радактировать</div>
                    <div data-options="id:'delete'">Удалить</div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="module">
import * as m from "./static/app/modules/__init__.js";

hotkeys('ctrl+a', function (event, handler){
    event.preventDefault();

    switch (handler.key) {
        case 'ctrl+a': alert('you pressed ctrl+a!'); 
        break;
    }
});

$(document).ready(() => {
    m.DockerContainers.fnPrepare();
    m.DockerImages.fnPrepare();
    m.DockerNetworks.fnPrepare();
    m.DockerVolumes.fnPrepare();
})
</script>