oauth2server.window.OAuth2ServerClients = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('oauth2server.clients.add')
        ,closeAction: 'close'
        ,url: oauth2server.config.connectorUrl
        ,action: 'mgr/clients/create'
        ,autoHeight: true
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('oauth2server.clients.domain_id')
            ,name: 'domain_id'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
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
            ,anchor: '100%'
            ,inputValue:'Yes'
        }]
         
    });
    oauth2server.window.OAuth2ServerClients.superclass.constructor.call(this,config);
};

Ext.extend(oauth2server.window.OAuth2ServerClients, MODx.Window);
Ext.reg('oauth2server-window-clients', oauth2server.window.OAuth2ServerClients);
