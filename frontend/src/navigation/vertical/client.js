export default [

    {

        title: 'Panel',
        route: 'firma',
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


    },
    {
        title: "Hizmet Geçmişi",
        icon: "ActivityIcon"
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
