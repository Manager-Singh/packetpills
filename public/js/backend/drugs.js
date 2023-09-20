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

                        { data: 'drug_image', name: 'drugs.drug_image' },
                        { data: 'brand_name', name: 'drugs.brand_name' },
                        { data: 'generic_name', name: 'drugs.generic_name' },
                        { data: 'main_therapeutic_use', name: 'drugs.main_therapeutic_use' },
                        { data: 'drug_strength', name: 'drugs.strength' },
                        { data: 'format_id', name: 'drugs.format_id' },
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
                strengthunit: jQuery(".strength-unit"),
                formats: jQuery(".format"),
                pack_unit: jQuery(".pack_unit"),
                insurance_coverage: jQuery(".insurance_coverage"),
                
                
            },

            init: function (locale) {
                this.addHandlers(locale);
                FTX.tinyMCE.init(locale);
            },

            addHandlers: function (locale) {

                this.selectors.status.select2({
                    width: '100%'
                });
                this.selectors.strengthunit.select2({
                    width: '100%',
                    placeholder:'Select Strength Unit',
                    language: {
                        noResults: function() {
                       return `<button style="width: 100%" type="button"
                       class="btn btn-primary" 
                       onClick='newoption("strength_unit","Strength Unit","strength-unit")'>+ Add New Item</button>
                       </li>`;
                       }
                    },
                   escapeMarkup: function (markup) {
                       return markup;
                   },
                  });

                  this.selectors.formats.select2({
                    width: '100%',
                    placeholder:'Select Format',
                    language: {
                        noResults: function() {
                       return `<button style="width: 100%" type="button"
                       class="btn btn-primary" 
                       onClick='newoption("format","Format","format")'>+ Add New Item</button>
                       </li>`;
                       }
                    },
                   escapeMarkup: function (markup) {
                       return markup;
                   },
                  });
                  this.selectors.pack_unit.select2({
                    width: '100%',
                    placeholder:'Select Pack Unit',
                    language: {
                        noResults: function() {
                       return `<button style="width: 100%" type="button"
                       class="btn btn-primary" 
                       onClick='newoption("pack_unit","Pack Unit","pack_unit")'>+ Add New Item</button>
                       </li>`;
                       }
                    },
                   escapeMarkup: function (markup) {
                       return markup;
                   },
                  });
                  this.selectors.insurance_coverage.select2({
                    width: '100%',
                    placeholder:'Select insurance coverage in %',
                    language: {
                        noResults: function() {
                       return `<button style="width: 100%" type="button"
                       class="btn btn-primary" 
                       onClick='newoption("insurance_coverage","Insurance Coverage in %","insurance_coverage")'>+ Add New Item</button>
                       </li>`;
                       }
                    },
                   escapeMarkup: function (markup) {
                       return markup;
                   },
                  });
            },
        },
    }
})();