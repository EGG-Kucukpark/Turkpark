export default [

    {

        title: 'Panel',
        route: 'Home',
        icon: 'HomeIcon',
    },
    {

        title: 'Çalışan Bilgileri',
        route: 'calisanlar',
        icon: 'UserIcon',
    },
    {
        title: 'Hizmetler & Sonuçlar',
        icon: 'HeartIcon',
        children: [

            {
                title: 'Laboratuvar',
                route: 'laboratuvar'

            }, {
                title: 'İlk Yardım',
                route: 'ilkyardim',
            },
            {
                title: 'Testler',
                children: [{
                        title: 'Periyodik Kontroller',
                        route: 'periyodik'
                    },
                    {
                        title: 'Ortam Ölçümler',
                        route: 'ölcümler'

                    },
                    {
                        title: 'Asansör Periyodik Kontrol',
                        route: 'asansor'

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


        ]


    }, {
        title: "Hizmet Geçmişi",
        icon: "ActivityIcon",
        route: 'hizmet-gecmisi'
    },


    {
        title: 'Takvim',
        route: 'apps-calendar',
        icon: 'CalendarIcon',
    }, {
        title: 'Yapılacaklar',
        route: 'apps-todo',
        icon: 'CheckSquareIcon',
    }, {
        title: 'Ayarlar',
        route: 'profil',
        icon: 'SettingsIcon',
    },














]
