export default [

{

    title: 'Uzman',
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
{
    title: 'Kurumlar',
    icon: 'BriefcaseIcon',
    children: [

        {
            title: 'Çalışanlar',
            route: 'calisanlar',
            icon: 'ChevronsRightIcon',
        },
        {
            title: 'Firmalar',
            route: 'firmalar',
            icon: 'ChevronsRightIcon',
        }
    ]
},





]


