oauth2server.grid.OAuth2ServerClients = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: oauth2server.config.connectorUrl
        ,baseParams: {
            action: 'mgr/clients/getlist'
        }
        ,save_action: 'mgr/clients/updatefromgrid'
        ,autosave: true
        ,fields: ['client_id','client_secret','domain_id','redirect_uri','grant_types','scope','user_id','base_url','login_url','is_primary','token_controller_url','authorize_url']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [
            
        {
            header: _('oauth2server.clients.domain_id')
            ,dataIndex: 'domain_id'
            ,sortable: true
            ,width: 60
        },{
            header: _('oauth2server.clients.is_primary')
            ,dataIndex: 'is_primary'
            ,sortable: true
            ,width: 60
        },{
            header: _('oauth2server.clients.client_id')
            ,dataIndex: 'client_id'
            ,sortable: true
            ,width: 60
        },{
            header: _('oauth2server.clients.client_secret')
            ,dataIndex: 'client_secret'
            ,sortable: true
            ,width: 160
        },{
            header: _('oauth2server.clients.redirect_uri')
            ,dataIndex: 'redirect_uri'
            ,sortable: true
           ,width: 160
        },{
            header: _('oauth2server.clients.base_url')
            ,dataIndex: 'base_url'
            ,sortable: true
            ,width: 100
        }
        /*,{
            header: _('oauth2server.clients.grant_types')
            ,dataIndex: 'grant_types'
            ,sortable: true
            ,width: 60
        },{
            header: _('oauth2server.clients.scope')
            ,dataIndex: 'scope'
            ,sortable: true
            ,width: 60
        }*/,{
            header: _('oauth2server.clients.user_id')
            ,dataIndex: 'user_id'
            ,sortable: true
            ,width: 50
        },{
                header: _('oauth2server.clients.is_primary')
                ,dataIndex: 'is_primary'
                ,sortable: true
                ,width: 50
            }]
        ,tbar: [{
            text: _('oauth2server.clients.add')
            ,handler: this.addClient
            ,scope: this
        }]
    });
    
    oauth2server.grid.OAuth2ServerClients.superclass.constructor.call(this,config);
};
Ext.extend(oauth2server.grid.OAuth2ServerClients,MODx.grid.Grid,{
    filters: []
    
    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('oauth2server.clients.update')
            ,handler: this.updateClient
        });
        m.push({
            text: _('oauth2server.clients.duplicate')
            ,handler: this.duplicateClient
        });
        m.push('-');
        m.push({
            text: _('oauth2server.clients.remove')
            ,handler: this.removeClient
        });
        this.addContextMenuItem(m);
    }
    
    ,addClient: function(btn,e) {

        var addClient = MODx.load({
            xtype: 'oauth2server-window-clients'
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        addClient.show(e.target);

    }

    ,updateClient: function(btn,e) {
        if (!this.menu.record || !this.menu.record.client_id) return false;

        var updateClient = MODx.load({
            xtype: 'oauth2server-window-clients'
            ,title: _('oauth2server.clients.update') + this.menu.record.client_id
            ,action: 'mgr/clients/update'
            ,record: this.menu.record
            ,fields: [{
                xtype: 'textfield'
               ,fieldLabel: _('oauth2server.clients.domain_id')
                ,name: 'domain_id'
                ,anchor: '100%'
            },{
                xtype: 'hidden'
                ,fieldLabel: _('oauth2server.clients.client_id')
                ,name: 'client_id'
                ,anchor: '100%'
            },{
                xtype: 'textfield'
                ,fieldLabel: _('oauth2server.clients.client_secret')
                ,name: 'client_secret'
                ,anchor: '100%'
            },{
                xtype: 'textfield'
                ,fieldLabel: _('oauth2server.clients.base_url')
                ,name: 'base_url'
                ,anchor: '100%'
            },{
                xtype: 'textfield'
                ,fieldLabel: _('oauth2server.clients.login_url')
                ,name: 'login_url'
                ,anchor: '100%'
            },{
                xtype: 'textfield'
                ,fieldLabel: _('oauth2server.clients.redirect_uri')
                ,name: 'redirect_uri'
                ,anchor: '100%'
            },{
                xtype: 'textfield'
                ,fieldLabel: _('oauth2server.clients.grant_types')
                ,name: 'grant_types'
                ,anchor: '100%'
            },{
                xtype: 'textfield'
                ,fieldLabel: _('oauth2server.clients.scope')
                ,name: 'scope'
                ,anchor: '100%'
            },{
                xtype: 'textfield'
                ,fieldLabel: _('oauth2server.clients.token_controller_url')
                ,name: 'token_controller_url'
                ,anchor: '100%'
            },{
                xtype: 'textfield'
                ,fieldLabel: _('oauth2server.clients.authorize_url')
                ,name: 'authorize_url'
                ,anchor: '100%'
            },{
                xtype: 'xcheckbox'
                ,fieldLabel: _('oauth2server.clients.set_primary')
                ,name  : 'is_primary'
                ,id : 'is_primary'
                ,anchor: '100%'
                ,inputValue:'Yes'
            }]
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        updateClient.show(e.target);
        updateClient.setValues(this.menu.record);
        if(this.menu.record.is_primary == 'Yes') {
            var field = Ext.getCmp('is_primary');
            //console.log(field);
            if (field !== undefined) field.setValue(true);
        }
        
    }
    
    ,duplicateClient: function(btn,e) {
        if (!this.menu.record || !this.menu.record.client_id) return false;
        
        var duplicateClient = MODx.load({
            xtype: 'oauth2server-window-clients'
            ,title: _('oauth2server.clients.duplicate')
            ,action: 'mgr/clients/create'
            ,record: this.menu.record
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        duplicateClient.show(e.target);
        duplicateClient.setValues(this.menu.record);
    }
    
    ,removeClient: function(btn,e) {
        if (!this.menu.record) return false;
        
        MODx.msg.confirm({
            title: _('oauth2server.clients.remove')
            ,text: _('oauth2server.clients.remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/clients/remove'
                ,client_id: this.menu.record.client_id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }
});
Ext.reg('oauth2server-grid-clients',oauth2server.grid.OAuth2ServerClients);

