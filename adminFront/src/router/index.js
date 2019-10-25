import Vue from 'vue';
import Router from 'vue-router';

import dashboard from '../pages/Dashboard.vue';
import Social from '../pages/Social.vue';
import Media from '../pages/Media.vue';
import Snackbar from '../pages/Snackbar.vue';
import Chart from '../pages/Chart.vue';
import Mailbox from '../pages/Mailbox.vue';
import Calendar from '../pages/Calendar.vue';
import Login from '../pages/core/Login.vue';
import home from '../pages/Home.vue';
import Error from '../pages/core/Error.vue';
import Deny from '../pages/core/Deny.vue';

import UProfile from '../components/users/UProfile.vue';

//Togosime
import Page from '../view/page/index.vue';
import PageAdd from '../view/page/add.vue';
import PageUpdate from '../view/page/update.vue';
import Video from '../view/video/index.vue';
import VideoAdd from '../view/video/add.vue';
import VideoUpdate from '../view/video/update.vue';

import Utilisateur from '../view/utilisateur/index.vue';
import UtilisateurAdd from '../view/utilisateur/add.vue';
import UtilisateurUpdate from '../view/utilisateur/update.vue';

import CategorieImage from '../view/image/categorie/index.vue';
import CategorieImageAdd from '../view/image/categorie/add.vue';
import CategorieImageUpdate from '../view/image/categorie/update.vue';
import Image from '../view/image/index.vue';
import ImageAdd from '../view/image/add.vue';
import ImageUpdate from '../view/image/update.vue';
import Annonce from '../view/annonce/index.vue';
import AnnonceAdd from '../view/annonce/add.vue';
import AnnonceUpdate from '../view/annonce/update.vue';
import Client from '../view/client/index.vue';
import ClientAdd from '../view/client/add.vue';
import ClientUpdate from '../view/client/update.vue';
import Message from '../view/message/index.vue';
import MessageAnswer from '../view/message/answer.vue';
import Parametre from '../view/parametre/index.vue';
import ParametreAdd from '../view/parametre/add.vue';
import ParametreUpdate from '../view/parametre/update.vue';
import Produit from '../view/produit/index.vue';
import ProduitAdd from '../view/produit/add.vue';
import ProduitUpdate from '../view/produit/update.vue';
import CategorieProduit from '../view/produit/categorie/index.vue';
import CategorieProduitAdd from '../view/produit/categorie/add.vue';
import CategorieProduitUpdate from '../view/produit/categorie/update.vue';
import GammeProduit from '../view/produit/gamme/index.vue';
import GammeProduitAdd from '../view/produit/gamme/add.vue';
import GammeProduitUpdate from '../view/produit/gamme/update.vue';
import Partenaire from '../view/partenaire/index.vue';
import PartenaireAdd from '../view/partenaire/add.vue';
import PartenaireUpdate from '../view/partenaire/update.vue';
import OrderPending from '../view/commande/enCours.vue'
import OrderValidated from '../view/commande/valide.vue'
import OrderDetail from '../view/commande/detail.vue'




import store from '../store';

const ifAuthenticated = (to, from, next) => {

    if (!store.state.userIsConnect) {
        console.log('not connected');
        next('/login');

        //  next('/403');
        return;
    }

    if (store.state.userIsConnect) {
        next();
        return;
    }
    next('/login');
    // next()

};



Vue.use(Router);

export default new Router({
    base: '/',
    mode: 'history',
    linkActiveClass: 'active',
    routes: [{
            path: '/',
            meta: {},
            name: 'Root',
            redirect: {
                name: 'dashboard'
            },
            beforeEnter: ifAuthenticated
        },
        {
            path: '/home',
            name: 'home',
            component: home,
            meta: {
                breadcrumb: [
                    { name: 'Accueil' }
                ]
            },
            beforeEnter: ifAuthenticated


        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: dashboard,
            meta: {
                breadcrumb: [
                    { name: 'Tableau de bord' }
                ]
            },
            beforeEnter: ifAuthenticated
        },
        {
          path: '/setting',
          name: 'setting',
          component: Parametre,
          meta: {
              breadcrumb: [
                  { name: 'Parametre' }
              ]
          },
          beforeEnter: ifAuthenticated
      },
      {
        path: '/parametre/add',
        name: 'parametre_add',
        component: ParametreAdd,
        meta: {
            breadcrumb: [
                { name: store.state.appName, href: 'dashboard' },
                { name: 'Ajouter parametre' }
            ]
        },
        beforeEnter: ifAuthenticated

      },

      {
        path: '/parametre/update/:id',
        name: 'parametre_edit',
        component: ParametreUpdate,
        meta: {
            breadcrumb: [
                { name: store.state.appName, href: 'dashboard' },
                { name: 'Details parametre' }
            ]
        },
        beforeEnter: ifAuthenticated

      },
        {
            path: '/mailbox',
            name: 'Mailbox',
            component: Mailbox,
            meta: {
                breadcrumb: [
                    { name: 'dashboard', href: 'dashboard' },
                    { name: 'Mailbox' }
                ]
            }
        },
        {
            path: '/snackbar',
            name: 'Snackbar',
            component: Snackbar,
            meta: {
                breadcrumb: [
                    { name: 'dashboard', href: 'dashboard' },
                    { name: 'Snackbar' }
                ]
            }
        },
        {
            path: '/calendar',
            name: 'Calendar',
            component: Calendar,
            meta: {
                breadcrumb: [
                    { name: 'Tableau de bord', href: 'dashboard' },
                    { name: 'Calendar' }
                ]
            }
        },
        {
            path: '/social',
            name: 'Social',
            component: Social,
            meta: {
                breadcrumb: [
                    { name: 'dashboard', href: 'dashboard' },
                    { name: 'Social' }
                ]
            }
        },
        {
            path: '/media',
            name: 'Media',
            component: Media,
            meta: {
                breadcrumb: [
                    { name: 'dashboard', href: 'dashboard' },
                    { name: 'Media' }
                ]
            }
        },
        {
            path: '/chart',
            name: 'Chart',
            component: Chart,
            meta: {
                breadcrumb: [
                    { name: 'dashboard', href: 'dashboard' },
                    { name: 'Chart' }
                ]
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            meta: {
                allowAnonymous: true
            }
        },
        {
            path: '/users/profile',
            name: 'users_profile',
            component: UProfile,
            meta: {
                breadcrumb: [
                    { name: store.state.appName, href: 'dashboard' },
                    { name: 'Mon profil' }
                ]
            },
            beforeEnter: ifAuthenticated

        },
        //client
        {
          path: '/client/list',
          name: 'client_list',
          component: Client,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des client' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/client/add',
          name: 'client_add',
          component: ClientAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter client' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/client/update/:id',
          name: 'client_edit',
          component: ClientUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details client' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //client

        //page
        {
          path: '/page/list',
          name: 'page_list',
          component: Page,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des pages' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/page/add',
          name: 'page_add',
          component: PageAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter page' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/page/update/:id',
          name: 'page_edit',
          component: PageUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details page' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //page

        //video
        {
          path: '/video/list',
          name: 'video_list',
          component: Video,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des video' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/video/add',
          name: 'video_add',
          component: VideoAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter video' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/video/update/:id',
          name: 'video_edit',
          component: VideoUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details video' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //video



//User
{
  path: '/user/list',
  name: 'user_list',
  component: Utilisateur,
  meta: {
      breadcrumb: [
          { name: store.state.appName, href: 'dashboard' },
          { name: 'Liste des utilisateur' }
      ]
  },
  beforeEnter: ifAuthenticated

},

{
  path: '/user/add',
  name: 'user_add',
  component: UtilisateurAdd,
  meta: {
      breadcrumb: [
          { name: store.state.appName, href: 'dashboard' },
          { name: 'Ajouter utilisateur' }
      ]
  },
  beforeEnter: ifAuthenticated

},

{
  path: '/user/update/:id',
  name: 'user_edit',
  component: UtilisateurUpdate,
  meta: {
      breadcrumb: [
          { name: store.state.appName, href: 'dashboard' },
          { name: 'Details utilisateur' }
      ]
  },
  beforeEnter: ifAuthenticated

},
//User




        //image
        {
          path: '/image/list',
          name: 'image_list',
          component: Image,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des image' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/image/add',
          name: 'image_add',
          component: ImageAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter image' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/image/update/:id',
          name: 'image_edit',
          component: ImageUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details image' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //image

        //image_category
        {
          path: '/image_category/list',
          name: 'image_category_list',
          component: CategorieImage,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des categorie' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/image_category/add',
          name: 'image_category_add',
          component: CategorieImageAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter categorie' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/image_category/update/:id',
          name: 'image_category_edit',
          component: CategorieImageUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details categorie' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //image_category

        //annonce
        {
          path: '/annonce/list',
          name: 'annonce_list',
          component: Annonce,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des annonce' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/annonce/add',
          name: 'annonce_add',
          component: AnnonceAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter annonce' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/annonce/update/:id',
          name: 'annonce_edit',
          component: AnnonceUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details annonce' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //annonce


        //message
        {
          path: '/message/list',
          name: 'message_list',
          component: Message,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des messages' }
              ]
          },
          beforeEnter: ifAuthenticated

        },


        {
          path: '/message/answer/:id',
          name: 'message_edit',
          component: MessageAnswer,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Repondre au mesage' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //video

        //produit
        {
          path: '/product/list',
          name: 'product_list',
          component: Produit,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des produits' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/product/add',
          name: 'product_add',
          component: ProduitAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter produit' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/product/update/:id',
          name: 'product_edit',
          component: ProduitUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details produit' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //produit

        //product_category
        {
          path: '/product_category/list',
          name: 'product_category_list',
          component: CategorieProduit,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des categorie' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/product_category/add',
          name: 'product_category_add',
          component: CategorieProduitAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter categorie' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/product_category/update/:id',
          name: 'product_category_edit',
          component: CategorieProduitUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details categorie' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //product_category

        //product_gamme
        {
          path: '/product_gamme/list',
          name: 'product_gamme_list',
          component: GammeProduit,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des gammes' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/product_gamme/add',
          name: 'product_gamme_add',
          component: GammeProduitAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter gamme' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/product_gamme/update/:id',
          name: 'product_gamme_edit',
          component: GammeProduitUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details gamme' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //product_gamme

        //provider
        {
          path: '/provider/list',
          name: 'provider_list',
          component: Partenaire,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des partenaires' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/provider/add',
          name: 'provider_add',
          component: PartenaireAdd,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Ajouter partenaire' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/provider/update/:id',
          name: 'provider_edit',
          component: PartenaireUpdate,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details partenaire' }
              ]
          },
          beforeEnter: ifAuthenticated
        },
        //provider


        //order
        {
          path: '/order_validated',
          name: 'order_validated',
          component: OrderValidated,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Liste des commandes validées' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/order_pending',
          name: 'order_pending',
          component: OrderPending,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Commandes en cours' }
              ]
          },
          beforeEnter: ifAuthenticated

        },

        {
          path: '/order/detail/:id',
          name: 'order_detail',
          component: OrderDetail,
          meta: {
              breadcrumb: [
                  { name: store.state.appName, href: 'dashboard' },
                  { name: 'Details fournisseur' }
              ]
          },
          beforeEnter: ifAuthenticated

        },
        //order

        {
            path: '/error',
            name: 'Error',
            component: Error,
            meta: {
                allowAnonymous: true
            }
        },
        {
            path: '/403',
            name: '403',
            component: Deny,
            meta: {
                allowAnonymous: true
            }
        }

    ]
});
