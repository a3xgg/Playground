const routes = [
  {
    name: 'index',
    path: '/dashboard',
    component: require('../components/dashboard/DashboardWrapper').default,
  },
  {
    name: 'profile',
    path: '/profile',
    component: require('../components/dashboard/ProfileComponent').default,
  }
];

export default routes;