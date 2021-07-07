export default [

    {

        title: 'Ana Sayfa',
        route: 'firma',
        icon: 'HomeIcon',
    },

    {
        title: 'Sonuçlar & Belgeler',
        icon: 'HeartIcon',
        children: [

            {
                title: 'Laboratuvar',
                route: 'laboratuvar'

            }, {
                title: 'Asansör',
                route: 'asansor'

            }, {
                title: 'Ortam Ölçümleri',
                route: 'ortam'

            }, {
                title: 'Periyodik Kontroller',
                route: 'periyodik'
            }, {
                title: 'İlk Yardım',
                route: 'ilkyardim'

            }, {
                title: 'Eğitimler',
                route: 'egitimler'

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