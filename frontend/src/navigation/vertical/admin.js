export default [

    {

        title: 'Ana Sayfa',
        route: 'Home',
        icon: 'HomeIcon',
    },
    {
        title: 'Müşteriler ',
        icon: 'BriefcaseIcon',
        children: [{
                title: 'Kurumsal Müşteri',
                route: 'clients',
                icon: 'ChevronsRightIcon',
            },
            {
                title: 'Bireysel Müşteri',
                route: 'individual',
                icon: 'ChevronsRightIcon',
            },

        ]
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
        title: 'Sonuçlar',
        route: 'results',
        icon: 'HeartIcon',


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


    {
        title: 'Arşivler',
        route: 'arsiv',
        icon: 'ArchiveIcon',


    },

    {
        title: 'Ayarlar',
        icon: 'SettingsIcon',
        children: [

            {
                title: 'Kullanıcılar',
                route: 'users',
                icon: 'UserIcon',

            }, {
                title: 'Rapor Tipleri',
                route: 'raporlar',
                icon: 'FileTextIcon',
            },
        ]

    },




]
