export default [

    {

        title: 'Ana Sayfa',
        route: 'Home',
        icon: 'HomeIcon',
    },
    {
        title: 'Müşteriler ',
        icon: 'BriefcaseIcon',
        route:'musteriler',

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
                title: 'İlk Yardım',

                route: 'apps-invoice-list',
                children: [{

                        title: 'Sertifikalar',
                        route: 'sertifika'

                    },
                    {
                        title: 'Eğitim Planlama',
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
                        title: 'Rapor Türleri',
                        route: 'rapor-turu',
                        icon: 'FileTextIcon',
                    },
                    {
                        title: 'Dosya Türleri',
                        route: 'dosya-turu',
                        icon: 'FileTextIcon',
                    },
                    {
                        title: 'Eğitim Türleri',
                        route: 'egitim-turu',
                        icon: 'FileTextIcon',
                    },
                ]

            }
        ]

    }




]
