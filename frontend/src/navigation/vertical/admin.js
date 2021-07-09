export default [

    {

        title: 'Panel',
        route: 'Home',
        icon: 'HomeIcon',
    },
    {
        title: 'Müşteriler ',
        icon: 'BriefcaseIcon',
        route: 'musteriler',

    },


    {
        title: 'Hizmetler & Sonuçlar',
        icon: 'FileTextIcon',
        children: [{
                title: 'Laboratuvar',
                route: 'flaboratuvar'

            },
            {
                title: 'İlk Yardım',

                route: 'apps-invoice-list',
                children: [{

                        title: 'Kursiyerler',
                        route: 'kursiyerler'

                    },
                    {
                        title: 'Eğitim Planlama',
                        route: 'egitim'

                    },



                ]
            },

            {
                title: 'Testler',
                children: [{
                        title: 'Periyodik Kontroller',
                        route: 'fperiyodik'
                    },
                    {
                        title: 'Ortam Ölçümler',
                        route: 'fölcümler'

                    },
                    {
                        title: 'Asansör Periyodik Kontrol',
                        route: 'fasansor'

                    }

                ]

            },


            {

                title: "İBYS",


            },


            {

                title: "Eğitimler",
                children: [{
                        title: "Uzaktan"
                    },
                    {
                        title: "Yüksekte Çalışma"
                    },
                    {
                        title: "Sapancı"
                    },
                    {
                        title: "IOSH"
                    },


                    {
                        title: "NEBOSH  "
                    }
                ]

            },

            {
                title: "Mesleki Yeterlilik"
            },
            {
                title: "Danışmanlık",
                children: [{
                        title: "Tehlikeli Madde Güvenlik"
                    },
                    {
                        title: "Asbest Söküm"
                    },
                    {
                        title: "Patlamadan Korunma Dokümanı"
                    },
                    {
                        title: "Yangın Güvenlik Sistemleri"
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
