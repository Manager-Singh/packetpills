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
                        { data: 'strength', name: 'drugs.strength' },
                        { data: 'strength_unit', name: 'drugs.strength_unit' },
                        { data: 'format', name: 'drugs.format' },
                        { data: 'manufacturer', name: 'drugs.manufacturer' },
                        { data: 'pack_size', name: 'drugs.pack_size' },
                        { data: 'pack_unit', name: 'drugs.pack_unit' },
                        { data: 'din', name: 'drugs.din' },
                        { data: 'presciption_required', name: 'drugs.presciption_required' },
                        { data: 'upc', name: 'drugs.upc' },
                        { data: 'pharmacy_purchase_price', name: 'drugs.pharmacy_purchase_price' },
                        { data: 'percent_markup', name: 'drugs.percent_markup' },
                        { data: 'drug_cost', name: 'drugs.drug_cost' },
                        { data: 'dispensing_fee', name: 'drugs.dispensing_fee' },
                        { data: 'insurance_coverage_in_percent', name: 'drugs.insurance_coverage_in_percent' },
                        { data: 'insurance_coverage_calculation_in_percent', name: 'drugs.insurance_coverage_calculation_in_percent' },
                        { data: 'delivery_cost', name: 'drugs.delivery_cost' },
                        { data: 'patient_pays', name: 'drugs.patient_pays' },
                        { data: 'drug_indication', name: 'drugs.drug_indication' },
                        { data: 'standard_dosage', name: 'drugs.standard_dosage' },
                        { data: 'side_effect', name: 'drugs.side_effect' },
                        { data: 'contraindications', name: 'drugs.contraindications' },
                        { data: 'precautions', name: 'drugs.precautions' },
                        { data: 'warnings', name: 'drugs.warnings' },
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