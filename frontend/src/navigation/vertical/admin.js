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
        title: 'Belge İşlemleri',
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

                    }


                ]
            },

            {
                title: 'Ortam Ölçümleri',

            },

            {
                title: 'Periyodik Kontroller',
                children:[{

                    title: "Yangın Güvenlik Sistemleri"
                }]

            },


            {
                title: "Asansör Kontrolleri",

            }

        ],
    },


    {
        title: 'Yapılacaklar',
        route: 'apps-todo',
        icon: 'CheckSquareIcon',
    },
    {
        title: 'Takvim',
        route: 'apps-calendar',
        icon: 'CalendarIcon',
    },



    {
        title: 'Ayarlar',
        icon: 'SettingsIcon',
        children:[

            {
                title: 'Kullanıcılar',
                route: 'users',
                icon: 'UserIcon',

            },
        ]

    },


    {
        title: 'Sonuçlar',
        route: 'results',
        icon: 'HeartIcon',
        children: [

            {
                title: 'Laboratuvar',
                route: 'results',
                icon: 'ChevronsRightIcon',

            },

            {
                title: 'Ölçümler',
                route: 'measures',
                icon: 'ChevronsRightIcon',
                tag: "Yeni"
            },

            {
                title: 'Tahliller',
                route: '',
                icon: 'ChevronsRightIcon',
            }


        ]

    },


]
