(function () {

    FTX.Prescriptionexisting = {

        list: {

            selectors: {
                Prescriptionexisting: $('#prescriptions-existing-table'),
            },

            init: function () {
                

                this.selectors.Prescriptionexisting.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.Prescriptionexisting.data('ajax_url'),
                        type: 'post'
                    },
                    columns: [
                        { data: 'prescription_number', name: 'prescription_number' },
                        { data: 'patient_name', name: 'patient_name' },
                        { data: 'medication_name', name: 'medication_name' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'status', name: 'status' },
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
            init: function (locale) {
                FTX.tinyMCE.init(locale);
            }
        },
    }
})();