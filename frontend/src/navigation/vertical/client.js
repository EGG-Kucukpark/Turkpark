export default [

    {

        title: 'Ana Sayfa',
        route: 'firma',
        icon: 'HomeIcon',
    },
    {

        title: 'Çalışanlar',
        route: 'calisanlar',
        icon: 'UserIcon',
    },


    {
        title: 'Hizmetler',
        icon: 'FileTextIcon',
        children: [{
                title: 'İlkyardım',

                route: 'apps-invoice-list',
                children: [{

                        title: 'Sertifikalar',
                        route: 'sertifika'

                    },
                    {
                        title: 'Eğitimler',
                        route: 'egitim'

                    },



                ]
            },
            {

                title: "Eğitimler",
                children: [{
                        title: "Yüksekte Çalışma"
                    },
                    {
                        title: "Sapancı"
                    },
                    {
                        title: "NEBOSH  "
                    }
                ]

            }, {

                title: "Yangın Güvenlik Sistemleri",

            },
            {
                title: 'Ortam Ölçümleri',

            },

            {
                title: 'Periyodik Kontroller',


            },


            {
                title: "Asansör Muayene",

            },
            {
                title: "Mobil Sağlık",

            },



        ],
    },


    {
        title: 'Sonuçlar & Belgeler',
        icon: 'HeartIcon',
        children: [

            {
                title: 'Laboratuvar',

            }, {
                title: 'Asansör',

            }, {
                title: 'Ortam Ölçümleri',

            }, {
                title: 'Periyodik Kontroller',

            }, {
                title: 'İlk  Yardım',

            }, {
                title: 'Eğitimler',

            },


        ]


    },




    {
        title: 'Takvim',
        route: 'apps-calendar',
        icon: 'CalendarIcon',
    },
    {
        title: 'Yapılacaklar',
        route: 'apps-todo',
        icon: 'CheckSquareIcon',
    },





]
