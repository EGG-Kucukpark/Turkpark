export default [

    {

        title: 'Ana Sayfa',
        route: 'Home',
        icon: 'HomeIcon',
    },


    {
        title: 'Yapılacaklar',
        route: 'apps-todo',
        icon: 'CheckSquareIcon',
    },
    {
        title: 'Belge İşlemleri',
        icon: 'FileTextIcon',
        children: [{
                title: 'List',
                route: 'apps-invoice-list',
            },
            {
                title: 'Preview',
                route: {
                    name: 'apps-invoice-preview',
                    params: {
                        id: 4987
                    }
                },
            },
            {
                title: 'Edit',
                route: {
                    name: 'apps-invoice-edit',
                    params: {
                        id: 4987
                    }
                },
            },
            {
                title: 'Add',
                route: {
                    name: 'apps-invoice-add'
                },
            },
        ],
    },

    {
        title: 'Kullanıcılar',
        route: 'users',
        icon: 'UserIcon',

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
