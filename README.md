# Merlin_ReservationGrid v1.0
Sometimes reservations get stuck and especially when using 3rd party finance extensions, this extension gives you the ability to delete individual or all stock reservations directly from Magento 2's Admin Panel. 

Previously the only way to do this was from the database.

#### 
Install
####

bin/magento module:enable Merlin_ReservationGrid && bin/magento set:up && bin/magento s:d:c && bin/magento s:s:d -f en_US en_GB && bin/magento c:c && bin/magento c:f


Merlin's Reservation Grid V2.0 Release notes

1) Module dependencies (etc/module.xml)  
   We were depending on Magento_Inventory, but the table we're using (inventory_reservation) is actually created by the Magento_InventoryReservations module.
    Reordered the sequence so that InventoryReservations comes first, then UI.

2) ACL + menu (etc/acl.xml)  
   Our menu item lives under Sales (Magento_Sales::sales) so ACL should mirror that.

3) Controllers  
   We removed the unnecessary CsrfAwareActionInterface from Index (GETs don't need it).
   Injected model factory via constructor rather than using $this->_objectManager.  
   Cast incoming IDs to int, catch LocalizedException separately.

4) UI-component listing (view/adminhtml/ui_component/reservation_grid.xml)  
 We declared an exportButton but have no ExportCsv/ExportXml controllers. This has been removed.
 actionsColumn had no delete link defined so we've added it.

5) added an i18n/en_US.csv to ship our default translations.

Summary

- We're no longer using the ObjectManager in the controllers.
- Our ACL now lives under Magento_Sales. 
- The module sequence guarantees the MSI reservation table is present. 
- The grid will display a per' row Delete link and a working mass delete action and no broken Export button. 
- No more obsolete CSRF overrides on a pure GET action.
