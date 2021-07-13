import axios from '@axios'

export default {

    state: {
        file: null,


    },
    actions: {
        excel(state, {
            event,
            url
        }) {

            var file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function (hata, basarili) {
                let data = reader.result;

                try {
                    var workbook = XLSX.read(data, {
                        type: "binary"
                    });
                } catch (err) {
                    document.getElementById("hata").click();
                }

                workbook.SheetNames.forEach((sheet) => {
                    let rowObject = XLSX.utils.sheet_to_row_object_array(
                        workbook.Sheets[sheet], {
                            raw: false
                        }
                    );

                    this.excel = rowObject;
                });

                axios
                    .post("/api/" + url, {
                        data: this.excel
                    })
                    .then((res) => {
                        document.getElementById("basarili").click();
                    })
                    .catch((error) => {
                        document.getElementById("hata").click();
                    });
            };

            reader.readAsBinaryString(file);




        },


        excel_down:({commit}, url) => {

            axios.post("/api/" + url.url).then((res) => {
                commit('DWN_FILE', res.data)
            });






        }
    },

    mutations: {
        DWN_FILE(state, file) {
            state.file = file
        }
    },





}
