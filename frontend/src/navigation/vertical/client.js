


export default [

    {

        title: 'Firma',
        route: 'anasayfa',
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
        children: [
          {
            title: 'List',
            route: 'apps-invoice-list',
          },
          {
            title: 'Preview',
            route: { name: 'apps-invoice-preview', params: { id: 4987 } },
          },
          {
            title: 'Edit',
            route: { name: 'apps-invoice-edit', params: { id: 4987 } },
          },
          {
            title: 'Add',
            route: { name: 'apps-invoice-add' },
          },
        ],
      },






    ]


