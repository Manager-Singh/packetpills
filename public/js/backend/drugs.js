(function () {

    FTX.Drugs = {

        list: {

            selectors: {
                drugs_table: $('#drugs-table'),
            },

            init: function () {

                this.selectors.drugs_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.drugs_table.data('ajax_url'),
                        type: 'post',
                    },
                    columns: [

                        { data: 'brand_name', name: 'drugs.brand_name' },
                        { data: 'generic_name', name: 'drugs.generic_name' },
                        { data: 'main_therapeutic_use', name: 'drugs.main_therapeutic_use' },
                        { data: 'drug_strength', name: 'drugs.strength' },
                        { data: 'format', name: 'drugs.format' },
                        { data: 'manufacturer', name: 'drugs.manufacturer' },
                        { data: 'drug_pack', name: 'drugs.pack_size' },
                        { data: 'pharmacy_purchase_price', name: 'drugs.pharmacy_purchase_price' },
                        { data: 'drug_cost', name: 'drugs.drug_cost' },
                        { data: 'dispensing_fee', name: 'drugs.dispensing_fee' },
                        { data: 'patient_pays', name: 'drugs.patient_pays' },
                        { data: 'display_status', name: 'drugs.status' },
                        { data: 'created_at', name: 'drugs.created_at' },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }

                    ],
                    order: [[3, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        FTX.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },

        edit: {
            selectors: {
                
                status: jQuery(".status"),
            },

            init: function (locale) {
                this.addHandlers(locale);
                FTX.tinyMCE.init(locale);
            },

            addHandlers: function (locale) {

                

                

                this.selectors.status.select2({
                    width: '100%'
                });

                
            },
        },
    }
})();