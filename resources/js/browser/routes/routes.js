const routes = [
  {
    name: 'index',
    path: '/',
    redirect: '/dashboard'
  },
  {
    name: 'dashboard',
    path: '/dashboard',
    component: require('../components/dashboard/DashboardWrapper').default,
  },
  {
    name: 'profile',
    path: '/profile',
    component: require('../components/dashboard/ProfileComponent').default,
  },
  {
    name: 'login',
    path: '/login',
    component: require('../components/auth/LoginComponent').default
  },
  {
    name: 'register',
    path: '/register',
    component: require('../components/auth/RegisterComponent').default
  }
];

export default routes;