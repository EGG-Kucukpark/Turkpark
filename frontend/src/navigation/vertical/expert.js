export default [

{

    title: 'Uzman',
    route: 'anasayfa',
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
    title: 'Yapılacaklar',
    route: 'apps-todo',
    icon: 'CheckSquareIcon',
  },





]


