import VueRouter from 'vue-router'
// Pages
import Register from './pages/Register'
import Login from './pages/Login'
import admin_login from './pages/Login'
import PasswordResetMail from './pages/Passwordreset'
import PasswordResetForm from './pages/Passwordresetform'
import Newsdetails from "./components/Newsdetails.vue";
import hospitalSearch from "./components/hospitalSearch.vue";
import JobApply from "./components/JobApply.vue";
import jobapplylist from "./components/jobapplylist.vue";
import customerlist from "./components/customerlist.vue";
import JobSearchListComponent from "./components/JobSearchListComponent.vue";
import job_details from "./components/job_details.vue";
import news_list from "./components/news_list.vue";
import create_news from "./components/create_news.vue";
import categorylist from "./components/categorylist.vue";
import createcategory from "./components/createcategory.vue";
// import stationlist from "./components/stationlist.vue";
// import createstation from "./components/createstation.vue";
// import editstation from "./components/editstation.vue";
import FacilitiesListComponent from "./components/FacilitiesListComponent.vue";
import CreateFacilityComponent from "./components/CreateFacilityComponent.vue";
// import custedit from "./components/custedit.vue";
// import CustomerSearchListComponent from "./components/CustomerSearchListComponent.vue";
// import NewsSearchListComponent from "./components/NewsSearchListComponent.vue";
// import map from "./components/map.vue";
import EditFacilityComponent from "./components/EditFacilityComponent.vue";
import editcategory from "./components/editcategory.vue";
// import createcustomer from "./components/CreateCustomer.vue";
import joboffercreate from "./components/JobOfferCreate.vue";
import editPost from "./components/editNewsPost.vue";
import Profile from "./components/Profile.vue";
import JobOfferList from "./components/JobOfferList.vue";
import ProfileEdit from "./components/ProfileEdit.vue";
import ProfilePublish from "./components/ProfilePublish.vue";
import advertisement from "./components/advertisement.vue";
import createmedicalacceptance from "./components/createmedicalacceptance.vue";
import medicalacceptancelist from "./components/medicalacceptancelist.vue";
import editmedicalacceptance from "./components/editmedicalacceptance.vue";
// import userPasswordResetList from "./components/userPasswordResetList.vue";
import HospitalHistory from "./components/HospitalHistory.vue";
import favouriteHospital from "./components/favouriteHospital.vue";
import NursingHistory from "./components/NursingHistory.vue";
// import HospitalProfile from "./components/HospitalProfile.vue";
// import NursingProfile from "./components/NursingProfile.vue";
// import VideoUpload from "./components/VideoUpload.vue";
import GoogleMap from "./components/GoogleMap.vue";
// import type from "./components/Type.vue";
// import typelist from "./components/TypeList.vue";
import subject from "./components/Subject.vue";
import subjectlist from "./components/SubjectList.vue";
import advertisementlist from "./components/advertisementlist.vue";
import editadvertisement from "./components/editadvertisement.vue";
import comment from "./components/Comment.vue";
import commentlist from "./components/commentlist.vue";
import featurelist from "./components/FeatureList.vue";
import favouriteNursing from "./components/favouriteNursing.vue";
import passport from "./components/passport.vue";
import specialfeature from "./components/CreateSpecialFeature.vue";
import nursingFavouriteMail from "./components/nursingFavouriteMail.vue";
import nursingMailConfirm from "./components/nursingMailConfirm.vue";
import modal from './components/modal.vue';
import termsAndConditions from './components/termsAndConditions.vue';
import occupation from './components/occupation.vue';
import occupationlist from './components/occupationlist.vue';
import nursingSearch from './components/nursingSearch.vue';
import jobSearch from './components/jobSearch.vue';
import News from './components/News.vue';
import Unauthorized from './components/419.vue';
import Jobapplicantlist from './components/Jobapplicantlist.vue'

// import menu from './components/menu/Menu.vue';

// Routes
const routes = [

    {
        path: '/Unauthorized',
        name: 'Unauthorized',
        component: Unauthorized,
    },

    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/admin_login',
        name: 'admin_login',
        component: admin_login,
        meta: {
            auth: false
        }
    },

    {
        path: '/reset',
        name: 'reset',
        component: PasswordResetMail,
        meta: {
            auth: false
        }
    },
    {
        path: '/resetpassword',
        name: 'resetpassword',
        component: PasswordResetForm,
        meta: {
            auth: false
        }
    },
    // USER ROUTES
    // {
    //   path: '/dashboard',
    //   name: 'dashboard',
    //   component: Dashboard,
    //   meta: {
    //     auth: true
    //   }
    // },
    // // ADMIN ROUTES
    // {
    //   path: '/admin',
    //   name: 'admin.dashboard',
    //   component: AdminDashboard,
    //   meta: {
    //     auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
    //   }
    // },

    {
        name: 'News',
        path: '/',
        component: News,
        meta: {
            auth: undefined
        }
    },

    {
        name: 'jobSearch',
        path: '/jobSearch',
        component: jobSearch
    },

    {
        name: 'nursingSearch',
        path: '/nursingSearch',
        component: nursingSearch
    },
    {
        name: "passport",
        path: "/passport",
        component: passport
    },

    {
        name: "newdetails",
        path: "/newsdetails/:id",
        component: Newsdetails,
        meta: {
            auth: undefined
        }
    },
    {
        name: "hospital_search",
        path: "/hospital_search",
        component: hospitalSearch,
        meta: {
            auth: undefined
        }
    },
    {
        name: "jobapply",
        path: "/jobapply/:job_id",
        component: JobApply,
        meta: {
            auth: false
        }
    },
    {
        name: "nuscustomerlist",
        path: "/nuscustomerlist",
        component: customerlist,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "hoscustomerlist",
        path: "/hoscustomerlist",
        component: customerlist,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    // {
    //     name: "customersearchlist",
    //     path: "/customersearchlist",
    //     component: CustomerSearchListComponent
    // },
    // {
    //     name: "newssearchlist",
    //     path: "/newssearchlist",
    //     component: NewsSearchListComponent,
    // },
    // {
    //     name: "custedit",
    //     path: "/custsedit",
    //     component: custedit
    // },
    {
        name: "jobsearchlist",
        path: "/jobsearchlist",
        component: JobSearchListComponent,
        meta: {
            auth: undefined
        }
    },

    {
        name: "job_details",
        path: "/job_details/:id",
        component: job_details,
        meta: {
            auth: undefined
        }
    },
    {
        name: "news_list",
        path: "/news_list",
        component: news_list,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "create_news",
        path: "/create_news",
        component: create_news,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "editPost",
        path: "/editPost",
        component: editPost,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "categorylist",
        path: "/categorylist",
        component: categorylist,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "createcategory",
        path: "/createcategory",
        component: createcategory,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "editcategory",
        path: "/editcategory",
        component: editcategory,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    // {
    //     name: "stationlist",
    //     path: "/stationlist",
    //     component: stationlist
    // },
    // {
    //     name: "createstation",
    //     path: "/createstation",
    //     component: createstation
    // },
    // {
    //     name: "editstation",
    //     path: "/editstation",
    //     component: editstation
    // },
    {
        name: "facilitieslist",
        path: "/facilitieslist",
        component: FacilitiesListComponent,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "createfacility",
        path: "/createfacility",
        component: CreateFacilityComponent,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },

    {
        name: "editfacility",
        path: "/editfacility",
        component: EditFacilityComponent,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    // {
    //     name: "createcustomer",
    //     path: "/createcustomer",
    //     component: createcustomer
    // },
    {
        name: "profile",
        path: "/profile",
        component: Profile,
        meta: {
            auth: undefined
        }
    },
    {
        name: "profiledit",
        path: "/profiledit",
        component: ProfileEdit,
        meta: {
            auth: true,
        }
    },
    {
        name: "jobofferlist",
        path: "/jobofferlist",
        component: JobOfferList,
        meta: {
            auth: true
        }
    },
    {
        name: "jobapplicantlist",
        path: "/jobapplicantlist",
        component: Jobapplicantlist,
        meta: {
            auth: true
        }
    },
    {
        name: "joboffercreate",
        path: "/joboffercreate",
        component: joboffercreate,
        meta: {
            // auth: { roles: 1, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
            auth: true
        }
    },
    {
        name: "profilepublish",
        path: "/profilepublish",
        component: ProfilePublish,
        meta: {
            auth: undefined
        }
    },
    {
        name: "hospital_history",
        path: "/hospital_history",
        component: HospitalHistory,
        meta: {
            auth: false
        }
    },
    {
        name: "createmedicalacceptance",
        path: "/createmedicalacceptance",
        component: createmedicalacceptance,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },

    {
        name: "medicalacceptancelist",
        path: "/medicalacceptancelist",
        component: medicalacceptancelist,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },

    {
        name: "editmedicalacceptance",
        path: "/editmedicalacceptance",
        component: editmedicalacceptance,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    // {
    //     name: "userPasswordResetList",
    //     path: "/userPasswordResetList",
    //     component: userPasswordResetList
    // },
    {
        name: "advertisement",
        path: "/advertisement",
        component: advertisement,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },

    {
        name: "favouriteHospital",
        path: "/favouriteHospital",
        component: favouriteHospital,
        meta: {
            auth: false
        }
    },
    {
        name: "favouriteNursing",
        path: "/favouriteNursing",
        component: favouriteNursing,
        meta: {
            auth: false
        }
    },
    // {
    //     name: "type",
    //     path: "/type",
    //     component: type
    // },
    // {
    //     name: "typelist",
    //     path: "/typelist",
    //     component: typelist
    // },
    {
        name: "subject",
        path: "/subject",
        component: subject,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "subjectlist",
        path: "/subjectlist",
        component: subjectlist,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "ads",
        path: "/ads",
        component: advertisementlist,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },
    {
        name: "editadvertisement",
        path: "/editads",
        component: editadvertisement,
        meta: {
            auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
        }
    },
    {
      name: 'nursing_history',
      path: '/nursing_history',
      component: NursingHistory,
      meta: {
        auth: false
      }
    },
    {
      name: 'google_map',
      path: '/google_map',
      component: GoogleMap,
      meta: {
        auth: undefined
      }
    },
  {
    name: 'comment',
    path: '/comment/:customer_id',
    component: comment,
    meta: {
        auth: false
    }
  },
  {
    name: 'nuscommentlist',
    path: '/nuscommentlist',
    component: commentlist,
    meta: {
        auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
    }
  },
  {
    name: 'hoscommentlist',
    path: '/hoscommentlist',
    component: commentlist,
    meta: {
        auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
    }
  },
  {
    name: 'specialfeature',
    path: '/specialfeature',
    component: specialfeature,
    meta: {
        auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
    }
  },
  {
    name: 'featurelist',
    path: '/featurelist',
    component: featurelist,
    meta: {
        auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
    }
  },
  {
    name: 'nusfeaturelist',
    path: '/nusfeaturelist',
    component: featurelist,
    meta: {
        auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
    }
  },
  {
    name: 'hosfeaturelist',
    path: '/hosfeaturelist',
    component: featurelist,
    meta: {
        auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
    }
  },
  {
    name: 'nursingFavouriteMail',
    path: '/nursingFavouriteMail',
    component: nursingFavouriteMail,
    meta: {
        auth: false
    }
  },
  {
    name: 'nursingMailConfirm',
    path: '/nursingMailConfirm',
    component: nursingMailConfirm,
    meta: {
        auth: false
    }
  },
  {
    name: 'modal',
    path: '/modal',
    component: modal,
    meta: {
        auth: undefined
    }
  },
  {
    name: 'termsAndConditions',
    path: '/termsAndConditions',
    component: termsAndConditions,
    meta: {
        auth: false
    }
  },

    {
        name: 'occupation',
        path: '/occupation',
        component: occupation,
        meta: {
            auth: { roles: 2, redirect: { name: 'login' }, forbiddenRedirect: '/Unauthorized' }
        }
    },

  {
    name: 'occupationlist',
    path: '/occupationlist',
    component: occupationlist,
    meta: {
        // auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
        auth: true
    }
  },
  {
    name:'jobapplylist',
    path:'/jobapplylist',
    component:jobapplylist,
    meta: {
        auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/Unauthorized'}
    }
  },
]
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})
export default router
