import Tool from './components/Tool.vue';

Nova.booting((Vue, router, store) => {
  // Vue.config.devtools = true;

  router.addRoutes([
    {
      name: 'language-translation',
      path: '/language-translation',
      component: Tool,
    },
  ]);
})
