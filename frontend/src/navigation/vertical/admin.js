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
        title: 'Hizmetler & Sonuçlar',
        icon: 'FileTextIcon',
        children: [{
                title: 'Laboratuvar',
                route: 'flaboratuvar'

            }, {
                title: 'Asansör',
                route: 'fasansor'

            }, {
                title: 'Ortam Ölçümleri',
                route: 'fölcümler'

            }, {
                title: 'Periyodik Kontroller',
                route: 'fperiyodik'
            },



            {
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

            },




        ],
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
        children: [{
                title: 'Kullanıcılar',
                route: 'users',
                icon: 'UserIcon',

            },
            {
                title: "Tanımlamalar",
                children: [{
                        title: 'Rapor Tipleri',
                        route: 'raporlar',
                        icon: 'FileTextIcon',
                    },
                    {
                        title: 'Dosya Tipleri',
                        route: 'dosyalar',
                        icon: 'FileTextIcon',
                    },
                ]

            }
        ]

    }




]
