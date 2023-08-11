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

                        { data: 'name', name: 'drugs.name' },
                        { data: 'available_form', name: 'drugs.available_form' },
                        { data: 'strength', name: 'drugs.strength' },
                        { data: 'description', name: 'drugs.description' },
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