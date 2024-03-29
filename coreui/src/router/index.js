import Vue from "vue";
import Router from "vue-router";

// Containers
const TheContainer = () => import("@/containers/TheContainer");

// Views
const Dashboard = () => import("@/views/Dashboard");
const Colors = () => import("@/views/theme/Colors");
const Typography = () => import("@/views/theme/Typography");

const Charts = () => import("@/views/charts/Charts");
const Widgets = () => import("@/views/widgets/Widgets");

// Views - Components
const Cards = () => import("@/views/base/Cards");
const Forms = () => import("@/views/base/Forms");
const Switches = () => import("@/views/base/Switches");
const Tables = () => import("@/views/base/Tables");
const Tabs = () => import("@/views/base/Tabs");
const Breadcrumbs = () => import("@/views/base/Breadcrumbs");
const Carousels = () => import("@/views/base/Carousels");
const Collapses = () => import("@/views/base/Collapses");
const Jumbotrons = () => import("@/views/base/Jumbotrons");
const ListGroups = () => import("@/views/base/ListGroups");
const Navs = () => import("@/views/base/Navs");
const Navbars = () => import("@/views/base/Navbars");
const Paginations = () => import("@/views/base/Paginations");
const Popovers = () => import("@/views/base/Popovers");
const ProgressBars = () => import("@/views/base/ProgressBars");
const Tooltips = () => import("@/views/base/Tooltips");

// Views - Buttons
const StandardButtons = () => import("@/views/buttons/StandardButtons");
const ButtonGroups = () => import("@/views/buttons/ButtonGroups");
const Dropdowns = () => import("@/views/buttons/Dropdowns");
const BrandButtons = () => import("@/views/buttons/BrandButtons");

// Views - Icons
const CoreUIIcons = () => import("@/views/icons/CoreUIIcons");
const Brands = () => import("@/views/icons/Brands");
const Flags = () => import("@/views/icons/Flags");

// Views - Notifications
const Alerts = () => import("@/views/notifications/Alerts");
const Badges = () => import("@/views/notifications/Badges");
const Modals = () => import("@/views/notifications/Modals");

// Views - Pages
const Page404 = () => import("@/views/pages/Page404");
const Page500 = () => import("@/views/pages/Page500");
const Login = () => import("@/views/pages/Login");
const Register = () => import("@/views/pages/Register");
const Purchase = () => import("@/views/pages/Purchase");
const FreeStudent = () => import("@/views/pages/FreeStudent");
const FreeTrial = () => import("@/views/pages/FreeTrial");

// Users
const Users = () => import("@/views/users/Users");
const User = () => import("@/views/users/User");
const EditUser = () => import("@/views/users/EditUser");

//Notes
const Notes = () => import("@/views/notes/Notes");
const Note = () => import("@/views/notes/Note");
const EditNote = () => import("@/views/notes/EditNote");
const CreateNote = () => import("@/views/notes/CreateNote");

//Roles
const Roles = () => import("@/views/roles/Roles");
const Role = () => import("@/views/roles/Role");
const EditRole = () => import("@/views/roles/EditRole");
const CreateRole = () => import("@/views/roles/CreateRole");

//Bread
const Breads = () => import("@/views/bread/Breads");
const Bread = () => import("@/views/bread/Bread");
const EditBread = () => import("@/views/bread/EditBread");
const CreateBread = () => import("@/views/bread/CreateBread");
const DeleteBread = () => import("@/views/bread/DeleteBread");

//Resources
const Resources = () => import("@/views/resources/Resources");
const CreateResource = () => import("@/views/resources/CreateResources");
const Resource = () => import("@/views/resources/Resource");
const EditResource = () => import("@/views/resources/EditResource");
const DeleteResource = () => import("@/views/resources/DeleteResource");

//Email
const Emails = () => import("@/views/email/Emails");
const CreateEmail = () => import("@/views/email/CreateEmail");
const EditEmail = () => import("@/views/email/EditEmail");
const ShowEmail = () => import("@/views/email/ShowEmail");
const SendEmail = () => import("@/views/email/SendEmail");

const Menus = () => import("@/views/menu/MenuIndex");
const CreateMenu = () => import("@/views/menu/CreateMenu");
const EditMenu = () => import("@/views/menu/EditMenu");
const DeleteMenu = () => import("@/views/menu/DeleteMenu");

const MenuElements = () => import("@/views/menuElements/ElementsIndex");
const CreateMenuElement = () =>
  import("@/views/menuElements/CreateMenuElement");
const EditMenuElement = () => import("@/views/menuElements/EditMenuElement");
const ShowMenuElement = () => import("@/views/menuElements/ShowMenuElement");
const DeleteMenuElement = () =>
  import("@/views/menuElements/DeleteMenuElement");

const Media = () => import("@/views/media/Media");

// About
const OurTeam = () => import("@/views/about/OurTeam");
const Jobs = () => import("@/views/about/Jobs");
const Press = () => import("@/views/about/Press");

// Settings
const AcademicLevels = () => import("@/views/settings/AcademicLevels");
const Categories = () => import("@/views/settings/Categories");
const Cities = () => import("@/views/settings/Cities");
const Components = () => import("@/views/settings/Components");
const Countries = () => import("@/views/settings/Countries");
const Employees = () => import("@/views/settings/Employees");
const MeasureTools = () => import("@/views/settings/MeasureTools");
const MyUsers = () => import("@/views/settings/MyUsers");
const Nationalities = () => import("@/views/settings/Nationalities");
const SubCategories = () => import("@/views/settings/SubCategories");
const Subjects = () => import("@/views/settings/Subjects");
const SubSubjects = () => import("@/views/settings/SubSubjects");
const Units = () => import("@/views/settings/Units");
const UnitsMeasure = () => import("@/views/settings/UnitsMeasure");

//  Institusions
const InistitutionsDashboard = () => import("@/views/institutions/Dashboard");

//  Edit Profile
const EditAdmin = () => import("@/views/editProfile/Admin");
const EditStudent = () => import("@/views/editProfile/Student");
const EditTeacher = () => import("@/views/editProfile/Teacher");
const EditCoordinator = () => import("@/views/editProfile/Coordinator");
const EditSubjectCoordinator = () =>
  import("@/views/editProfile/SubjectCoordinator");
const EditFreeStudent = () => import("@/views/editProfile/FreeStudent");

// activity
const ActivityIndex = () => import("@/views/activity/ActivityIndex");
// const ActivityComponent = () => import("@/views/activity/ActivityComponent");
const ChartAndTable = () => import("@/views/activity/ChartAndTable");
const EndQuestion = () => import("@/views/activity/EndQuestion");
// coordinator
const CoordinatorSubjects = () => import("@/views/coordinator/MySubjects");
const CoordinatorSubjectsClasses = () => import("@/views/coordinator/Classes");
const SubjectClass = () => import("@/views/coordinator/Class");
const CoordinatorTeachers = () => import("@/views/coordinator/MyTeachers");
const TeacherClasses = () => import("@/views/coordinator/TeacherClasses");
const subjectClassActivities = () =>
  import("@/views/coordinator/SubjectClassActivities");
const subjectClassActivity = () =>
  import("@/views/coordinator/SubjectClassActivity");
const CoordinatorTeacherClass = () =>
  import("@/views/coordinator/TeacherClass");
const TeachersClassActivities = () =>
  import("@/views/coordinator/TeacherClassActivities");
const TeacherClassActivity = () =>
  import("@/views/coordinator/TeacherClassActivity");

// subject coordinator
const SubjectCoordinatorTeachers = () =>
  import("@/views/subjectCoordinator/MyTeachers");
const SubjectCoordinatorTeacherClasses = () =>
  import("@/views/subjectCoordinator/Classes");
const SubjectCoordinatorClass = () =>
  import("@/views/subjectCoordinator/Class");
const SubCoordinatorClassActivities = () =>
  import("@/views/subjectCoordinator/ClassActivities");
const SubCoordinatorClassActivity = () =>
  import("@/views/subjectCoordinator/activity");
//teacher
const MyTeacherClasses = () => import("@/views/teacher/TeacherClasses");
const MyTeacherClass = () => import("@/views/teacher/Class");
const TeacherClassActivities = () => import("@/views/teacher/Activities");
const TeacherActivity = () => import("@/views/teacher/activity");

//student
const MyStudentClasses = () => import("@/views/student/StudentClasses");
const ClassActivities = () => import("@/views/student/ClassActivities");
const studentActivity = () => import("@/views/student/Activity");

//free_student
const StudentActivities = () => import("@/views/freeStudent/Activities");
const FreeStudentActivity = () => import("@/views/freeStudent/Activity");

// permissions
const PermissionsIndex = () => import("@/views/permissions/PermissionsIndex");

// join class
const JoinClass = () => import("@/views/joinClass/JoinClassIndex");
const JoinEditCoordinator = () =>
  import("@/views/joinClass/joinEditCoordinator");
const AddTeacher = () => import("@/views/joinClass/addTeacher");

const JoinEditTeacher = () => import("@/views/joinClass/joinEditTeacher");
const addStudentsNum = () => import("@/views/joinClass/addStudentsNum");

const joinEditStudent = () => import("@/views/joinClass/joinEditStudent");
const LevelOfScaffolding = () => import("@/views/settings/LevelOfScaffolding");
const LocationInstructionalCycle = () =>
  import("@/views/settings/LocationInstructionalCycle");
const InstructionalPurpose = () =>
  import("@/views/settings/InstructionalPurpose");

//activity AdminsActivities
const CreateActivity = () => import("@/views/activity/CreateActivity");
const AdminsActivities = () => import("@/views/activity/ActivitiesDashboard");
const AdminsActivity = () => import("@/views/activity/activity");

/*
 AcademicLevels 
 Categories 
 Cities 
 Components 
 Countries 
 Employees 
 MeasureTools 
 MyUsers 
 Nationalities 
 SubCategories 
 Subjects 
 SubSubjects 
 Units 
 UnitsMeasure 
*/

Vue.use(Router);

let router = new Router({
  mode: "hash", // https://router.vuejs.org/api/#mode
  linkActiveClass: "active",
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes(),
});

router.beforeEach((to, from, next) => {
  let roles = localStorage.getItem("roles");
  if (roles != null) {
    roles = roles.split(",");
  }
  // console.log(
  //   "editor:",
  //   to.matched.some((record) => record.meta.requiresEditor)
  // );
  if (
    to.matched.some((record) => record.meta.requiresAdmin_Editor) &&
    roles != null &&
    roles.indexOf("admin") >= 0
  ) {
    // console.log("path match Admin", to);
    if (roles != null && roles.indexOf("admin") >= 0) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  } else if (to.matched.some((record) => record.meta.requiresUser)) {
    if (roles != null && roles.indexOf("user") >= 0) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  } else if (to.matched.some((record) => record.meta.requiresEditor)) {
    // console.log("path  match editor");
    if (roles != null && roles.indexOf("editor") >= 0) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  } else if (to.matched.some((record) => record.meta.requiresCoordinator)) {
    if (roles != null && roles.indexOf("coordinator") >= 0) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  } else if (to.matched.some((record) => record.meta.requiresTeacher)) {
    if (roles != null && roles.indexOf("teacher") >= 0) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  } else if (to.matched.some((record) => record.meta.requiresStudent)) {
    if (roles != null && roles.indexOf("student") >= 0) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  } else if (to.matched.some((record) => record.meta.requiresFreeStudent)) {
    if (roles != null && roles.indexOf("free_student") >= 0) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  } else if (
    to.matched.some((record) => record.meta.requiresSubjectCoordinator)
  ) {
    if (roles != null && roles.indexOf("subject_coordinator") >= 0) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  }
  // ADMIN - EDITOR
  else if (to.matched.some((record) => record.meta.requiresAdmin_Editor)) {
    if (
      roles != null &&
      (roles.indexOf("admin") >= 0 || roles.indexOf("editor") >= 0)
    ) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  }
  // teacher - coordinator - subject_coordinator
  else if (
    to.matched.some(
      (record) => record.meta.requiresTeacher_Coordinator_SubjectCoordinator
    )
  ) {
    if (
      roles != null &&
      (roles.indexOf("teacher") >= 0 ||
        roles.indexOf("coordinator") >= 0 ||
        roles.indexOf("subject_coordinator") >= 0)
    ) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  }
  // student - free_student
  else if (
    to.matched.some((record) => record.meta.requiresStudent_FreeStudent)
  ) {
    if (
      roles != null &&
      (roles.indexOf("student") >= 0 || roles.indexOf("free_student") >= 0)
    ) {
      next();
    } else {
      next({
        path: "/login",
        params: { nextUrl: to.fullPath },
      });
    }
  } else {
    console.log("path didnt match any role", to);
    next();
  }
});

export default router;

function configRoutes() {
  return [
    {
      path: "/",
      redirect: "/dashboard",
      name: "Home",
      component: TheContainer,
      children: [
        {
          path: "purchase",
          name: "Purchase",
          component: Purchase,
        },
        {
          path: "our-team",
          name: "Our Team",
          component: OurTeam,
        },
        {
          path: "careers",
          name: "Careers",
          component: Jobs,
        },
        {
          path: "press",
          name: "Press",
          component: Press,
        },
        {
          path: "free-trial",
          name: "Free Trial",
          component: FreeTrial,
        },
        {
          path: "free-student",
          name: "Free Student",
          component: FreeStudent,
        },
        // {
        //   path: "join-to-class",
        //   name: "Join Class",
        //   component: JoinClass,
        // },
        /* join class */

        {
          path: "join-to-class",
          meta: { label: "Join Class" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: JoinClass,
            },
            {
              path: ":id/join-edit-coordinator-profile",
              meta: { label: "edit coordinator profile" },
              component: {
                render(c) {
                  return c("router-view");
                },
              },
              children: [
                {
                  path: "",
                  component: JoinEditCoordinator,
                },
                {
                  path: "addTeachers",
                  name: "Add Teachers",
                  component: AddTeacher,
                },
              ],
            },
            {
              path: ":id/join-edit-teacher-profile",
              meta: { label: "edit teacher profile" },
              component: {
                render(c) {
                  return c("router-view");
                },
              },
              children: [
                {
                  path: "",
                  component: JoinEditTeacher,
                },
                {
                  path: "addStudentsNum",
                  name: "Students Number",
                  component: addStudentsNum,
                },
              ],
            },
            {
              path: ":id/join-edit-student-profile",
              meta: { label: "edit student profile" },
              component: {
                render(c) {
                  return c("router-view");
                },
              },
              children: [
                {
                  path: "",
                  component: joinEditStudent,
                },
              ],
            },

            // {
            //   path: "join-edit-coordinator-profile",
            //   name: "JoinEditCoordinator",
            //   component: JoinEditCoordinator,
            // },
          ],
        },
        {
          path: "media",
          name: "Media",
          component: Media,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "dashboard",
          name: "Dashboard",
          component: Dashboard,
        },
        {
          path: "colors",
          name: "Colors",
          component: Colors,
          meta: {
            requiresAdmin: true,
          },
        },
        {
          path: "typography",
          name: "Typography",
          component: Typography,
          meta: {
            requiresAdmin: true,
          },
        },
        {
          path: "charts",
          name: "Charts",
          component: Charts,
          meta: {
            requiresAdmin: true,
          },
        },
        {
          path: "widgets",
          name: "Widgets",
          component: Widgets,
          meta: {
            requiresAdmin: true,
          },
        },
        /* coordinator */
        {
          path: "coordinator-subjects",
          meta: { label: "My_Subjects" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: CoordinatorSubjects,
              meta: {
                requiresCoordinator: true,
              },
            },
            {
              path: ":subjectid/classes",
              meta: { label: "classes" },
              component: {
                render(b) {
                  return b("router-view");
                },
              },
              children: [
                {
                  path: "",
                  component: CoordinatorSubjectsClasses,
                  meta: {
                    requiresCoordinator: true,
                  },
                },
                {
                  path: ":classid/myclass",
                  meta: { label: "myclass" },
                  component: {
                    render(b) {
                      return b("router-view");
                    },
                  },
                  children: [
                    {
                      path: "",
                      component: SubjectClass,
                      meta: {
                        requiresCoordinator: true,
                      },
                    },
                    {
                      path: "myactivities",
                      meta: { label: "activities" },
                      component: {
                        render(b) {
                          return b("router-view");
                        },
                      },
                      children: [
                        {
                          path: "",
                          component: subjectClassActivities,
                          meta: {
                            requiresCoordinator: true,
                          },
                        },
                        {
                          path: ":activityid/activity",
                          name: "Class_Activity",
                          component: subjectClassActivity,
                          meta: {
                            requiresCoordinator: true,
                          },
                        },
                      ],
                    },
                  ],
                },
              ],
            },
          ],
        },
        //
        {
          path: "coordinator-teachers",
          meta: { label: "My_Teachers" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: CoordinatorTeachers,
              meta: {
                requiresCoordinator: true,
              },
            },
            {
              path: ":teacherid/teacherclasses",
              meta: { label: "Teacher_Classes" },
              component: {
                render(b) {
                  return b("router-view");
                },
              },
              children: [
                {
                  path: "",
                  component: TeacherClasses,
                  meta: {
                    requiresCoordinator: true,
                  },
                },
                {
                  path: ":classid/myclass",
                  meta: { label: "myclass" },
                  component: {
                    render(b) {
                      return b("router-view");
                    },
                  },
                  children: [
                    {
                      path: "",
                      component: CoordinatorTeacherClass,
                      meta: {
                        requiresCoordinator: true,
                      },
                    },
                    {
                      path: "myactivities",
                      name: "class-activities",
                      component: TeachersClassActivities,
                      meta: {
                        requiresCoordinator: true,
                      },
                    },
                    {
                      path: "myactivities",
                      meta: { label: "class-activities" },
                      component: {
                        render(b) {
                          return b("router-view");
                        },
                      },
                      children: [
                        {
                          path: "",
                          component: TeachersClassActivities,
                          meta: {
                            requiresCoordinator: true,
                          },
                        },
                        {
                          path: ":activityid/activity",
                          name: "class_Activity",
                          component: TeacherClassActivity,
                          meta: {
                            requiresCoordinator: true,
                          },
                        },
                      ],
                    },
                  ],
                },
              ],
            },
          ],
        },
        /* subject coordinator*/
        {
          path: "subject-coordinator-teachers",
          meta: { label: "SubjectCoordinatorTeachers" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: SubjectCoordinatorTeachers,
              meta: {
                requiresSubjectCoordinator: true,
              },
            },
            {
              path: ":teacherid/teacherclasses",
              meta: { label: "Teacher_Classes" },
              component: {
                render(b) {
                  return b("router-view");
                },
              },
              children: [
                {
                  path: "",
                  component: SubjectCoordinatorTeacherClasses,
                  meta: {
                    requiresSubjectCoordinator: true,
                  },
                },
                {
                  path: ":classid/myclass",
                  meta: { label: "Teacher-Class" },
                  component: {
                    render(b) {
                      return b("router-view");
                    },
                  },
                  children: [
                    {
                      path: "",
                      component: SubjectCoordinatorClass,
                      meta: {
                        requiresSubjectCoordinator: true,
                      },
                    },
                    {
                      path: "myactivities",
                      meta: { label: "myclass-activitie" },
                      component: {
                        render(b) {
                          return b("router-view");
                        },
                      },
                      children: [
                        {
                          path: "",
                          component: SubCoordinatorClassActivities,
                          meta: {
                            requiresSubjectCoordinator: true,
                          },
                        },
                        {
                          path: ":activityid/activity",
                          name: "class_activity",
                          component: SubCoordinatorClassActivity,
                          meta: {
                            requiresSubjectCoordinator: true,
                          },
                        },
                      ],
                    },
                  ],
                },
              ],
            },
          ],
        },
        /* teacher */
        {
          path: "teacher-classes",
          meta: { label: "TeacherClasses" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: MyTeacherClasses,
              meta: {
                requiresTeacher: true,
              },
            },
            {
              path: ":id/myclass",
              meta: { label: "TeacherClass" },
              component: {
                render(c) {
                  return c("router-view");
                },
              },
              children: [
                {
                  path: "",
                  component: MyTeacherClass,
                  meta: {
                    requiresTeacher: true,
                  },
                },
                {
                  path: ":myactivities",
                  meta: { label: "Activities" },
                  component: {
                    render(b) {
                      return b("router-view");
                    },
                  },
                  children: [
                    {
                      path: "",
                      component: TeacherClassActivities,
                      meta: {
                        requiresTeacher: true,
                      },
                    },
                    {
                      path: ":activityid/activity",
                      name: "my_activity",
                      component: TeacherActivity,
                      meta: {
                        requiresTeacher: true,
                      },
                    },
                  ],
                },
              ],
            },
          ],
        },
        /*student*/
        {
          path: "student-classes",
          meta: { label: "StudentClasses" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: MyStudentClasses,
              meta: {
                requiresStudent: true,
              },
            },
            {
              path: ":id/myclass",
              meta: { label: "Class_Activities" },
              component: {
                render(c) {
                  return c("router-view");
                },
              },
              children: [
                {
                  path: "",
                  component: ClassActivities,
                  meta: {
                    requiresStudent: true,
                  },
                },
                {
                  path: ":activityid/activity",
                  name: "Student_Activity",
                  component: studentActivity,
                  meta: {
                    requiresStudent: true,
                  },
                },
              ],
            },
          ],
        },
        /*free-student*/
        {
          path: "free-student-activities",
          meta: { label: "Student_Activities" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: StudentActivities,
              meta: {
                requiresFreeStudent: true,
              },
            },
            {
              path: ":myactivityid/myactivity",
              name: "My Activity",
              component: FreeStudentActivity,
              meta: {
                requiresFreeStudent: true,
              },
            },
          ],
        },
        /* Edit Profile */
        {
          path: "edit-admin-profile",
          name: "EditAdmin",
          component: EditAdmin,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "edit-coordinator-profile",
          name: "EditCoordinator",
          component: EditCoordinator,
          meta: {
            requiresCoordinator: true,
          },
        },
        {
          path: "edit-subject-coordinator-profile",
          name: "EditSubjectCoordinator",
          component: EditSubjectCoordinator,
          meta: {
            requiresSubjectCoordinator: true,
          },
        },
        {
          path: "edit-student-profile",
          name: "EditStudent",
          component: EditStudent,
          meta: {
            requiresStudent: true,
          },
        },
        {
          path: "edit-free-student-profile",
          name: "EditFreeStudent",
          component: EditFreeStudent,
          meta: {
            requiresFreeStudent: true,
          },
        },
        {
          path: "edit-teacher-profile",
          name: "EditTeacher",
          component: EditTeacher,
          meta: {
            requiresTeacher: true,
          },
        },
        /* activity */
        {
          path: "my-activities-ae",
          name: "Create Activities",
          component: CreateActivity,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "admin-activities-dashboard",
          meta: { label: "my Activities" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: AdminsActivities,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":AdminActivity/Activity",
              name: "My_Activity",
              component: AdminsActivity,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
          ],
        },
        {
          path: "activity-student",
          name: "Activity",
          component: ActivityIndex,
          meta: {
            requiresStudent_FreeStudent: true,
          },
        },
        // {
        //   path: "end_questions",
        //   name: "end_questions",
        //   component: EndQuestion,
        //   meta: {
        //     requiresAdmin: true,
        //   },
        // },
        {
          path: "activity-student3",
          name: "Activity3",
          component: ChartAndTable,
          meta: {
            requiresAdmin: true,
          },
        },
        {
          path: "activity",
          name: "Activity4",
          component: ActivityIndex,
          meta: {
            requiresAdmin: true,
          },
        },
        /* Institusions */
        {
          path: "institutions",
          name: "Institutions",
          component: InistitutionsDashboard,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        /* Admin - editor */
        {
          path: "permissions",
          name: "Permissions",
          component: PermissionsIndex,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "academic-levels",
          name: "AcademicLevels",
          component: AcademicLevels,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "categories",
          name: "Categories",
          component: Categories,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "cities",
          name: "Cities",
          component: Cities,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "components",
          name: "Components",
          component: Components,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "countries",
          name: "Countries",
          component: Countries,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "employees",
          name: "Employees",
          component: Employees,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "measure-tools",
          name: "MeasureTools",
          component: MeasureTools,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "my-users",
          name: "MyUsers",
          component: MyUsers,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "nationalities",
          name: "Nationalities",
          component: Nationalities,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "sub-categories",
          name: "SubCategories",
          component: SubCategories,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "subjects",
          name: "Subjects",
          component: Subjects,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "sub-subjects",
          name: "SubSubjects",
          component: SubSubjects,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "units",
          name: "Units",
          component: Units,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "units-measure",
          name: "UnitsMeasure",
          component: UnitsMeasure,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "level-of-scaffolding",
          name: "Level Of Scaffolding",
          component: LevelOfScaffolding,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "location-instructional-cycle",
          name: "Location Instructional Cycle",
          component: LocationInstructionalCycle,
          meta: {
            requiresAdmin_Editor: true,
          },
        },
        {
          path: "instructional-purpose",
          name: "Instructional Purpose",
          component: InstructionalPurpose,
          meta: {
            requiresAdmin_Editor: true,
          },
        },

        /* End of Admin - editor Routes*/
        {
          path: "menu",
          meta: { label: "Menu" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: Menus,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: "create",
              meta: { label: "Create Menu" },
              name: "CreateMenu",
              component: CreateMenu,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id/edit",
              meta: { label: "Edit Menu" },
              name: "EditMenu",
              component: EditMenu,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id/delete",
              meta: { label: "Delete Menu" },
              name: "DeleteMenu",
              component: DeleteMenu,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
          ],
        },
        {
          path: "menuelement",
          meta: { label: "MenuElement" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: ":menu/menuelement",
              component: MenuElements,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":menu/menuelement/create",
              meta: { label: "Create Menu Element" },
              name: "Create Menu Element",
              component: CreateMenuElement,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":menu/menuelement/:id",
              meta: { label: "Menu Element Details" },
              name: "Menu Element",
              component: ShowMenuElement,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":menu/menuelement/:id/edit",
              meta: { label: "Edit Menu Element" },
              name: "Edit Menu Element",
              component: EditMenuElement,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":menu/menuelement/:id/delete",
              meta: { label: "Delete Menu Element" },
              name: "Delete Menu Element",
              component: DeleteMenuElement,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
          ],
        },
        {
          path: "users",
          meta: { label: "Users" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: Users,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id",
              meta: { label: "User Details" },
              name: "User",
              component: User,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id/edit",
              meta: { label: "Edit User" },
              name: "Edit User",
              component: EditUser,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
          ],
        },
        {
          path: "notes",
          meta: { label: "Notes" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: Notes,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "create",
              meta: { label: "Create Note" },
              name: "Create Note",
              component: CreateNote,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: ":id",
              meta: { label: "Note Details" },
              name: "Note",
              component: Note,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: ":id/edit",
              meta: { label: "Edit Note" },
              name: "Edit Note",
              component: EditNote,
              meta: {
                requiresUser: true,
              },
            },
          ],
        },
        {
          path: "roles",
          meta: { label: "Roles" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: Roles,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: "create",
              meta: { label: "Create Role" },
              name: "Create Role",
              component: CreateRole,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id",
              meta: { label: "Role Details" },
              name: "Role",
              component: Role,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id/edit",
              meta: { label: "Edit Role" },
              name: "Edit Role",
              component: EditRole,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
          ],
        },
        {
          path: "bread",
          meta: { label: "Bread" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: Breads,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: "create",
              meta: { label: "Create Bread" },
              name: "CreateBread",
              component: CreateBread,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id",
              meta: { label: "Bread Details" },
              name: "Bread",
              component: Bread,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id/edit",
              meta: { label: "Edit Bread" },
              name: "Edit Bread",
              component: EditBread,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id/delete",
              meta: { label: "Delete Bread" },
              name: "Delete Bread",
              component: DeleteBread,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
          ],
        },
        {
          path: "email",
          meta: { label: "Emails" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "",
              component: Emails,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: "create",
              meta: { label: "Create Email Template" },
              name: "Create Email Template",
              component: CreateEmail,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id",
              meta: { label: "Show Email Template" },
              name: "Show Email Tempalte",
              component: ShowEmail,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id/edit",
              meta: { label: "Edit Email Tempalate" },
              name: "Edit Email Template",
              component: EditEmail,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
            {
              path: ":id/sendEmail",
              meta: { label: "Send Email" },
              name: "Send Email",
              component: SendEmail,
              meta: {
                requiresAdmin_Editor: true,
              },
            },
          ],
        },
        {
          path: "resource",
          meta: { label: "Resources" },
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: ":bread/resource",
              component: Resources,
            },
            {
              path: ":bread/resource/create",
              meta: { label: "Create Resource" },
              name: "CreateResource",
              component: CreateResource,
            },
            {
              path: ":bread/resource/:id",
              meta: { label: "Resource Details" },
              name: "Resource",
              component: Resource,
            },
            {
              path: ":bread/resource/:id/edit",
              meta: { label: "Edit Resource" },
              name: "Edit Resource",
              component: EditResource,
            },
            {
              path: ":bread/resource/:id/delete",
              meta: { label: "Delete Resource" },
              name: "Delete Resource",
              component: DeleteResource,
            },
          ],
        },
        {
          path: "base",
          redirect: "/base/cards",
          name: "Base",
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "cards",
              name: "Cards",
              component: Cards,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "forms",
              name: "Forms",
              component: Forms,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "switches",
              name: "Switches",
              component: Switches,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "tables",
              name: "Tables",
              component: Tables,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "tabs",
              name: "Tabs",
              component: Tabs,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "breadcrumb",
              name: "Breadcrumb",
              component: Breadcrumbs,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "carousel",
              name: "Carousel",
              component: Carousels,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "collapse",
              name: "Collapse",
              component: Collapses,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "jumbotron",
              name: "Jumbotron",
              component: Jumbotrons,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "list-group",
              name: "List Group",
              component: ListGroups,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "navs",
              name: "Navs",
              component: Navs,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "navbars",
              name: "Navbars",
              component: Navbars,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "pagination",
              name: "Pagination",
              component: Paginations,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "popovers",
              name: "Popovers",
              component: Popovers,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "progress",
              name: "Progress",
              component: ProgressBars,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "tooltips",
              name: "Tooltips",
              component: Tooltips,
              meta: {
                requiresAdmin: true,
              },
            },
          ],
        },
        {
          path: "buttons",
          redirect: "/buttons/standard-buttons",
          name: "Buttons",
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "buttons",
              name: "Standard Buttons",
              component: StandardButtons,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "button-group",
              name: "Button Group",
              component: ButtonGroups,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "dropdowns",
              name: "Dropdowns",
              component: Dropdowns,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "brand-buttons",
              name: "Brand Buttons",
              component: BrandButtons,
              meta: {
                requiresAdmin: true,
              },
            },
          ],
        },
        {
          path: "icon",
          redirect: "/icons/coreui-icons",
          name: "CoreUI Icons",
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "coreui-icons",
              name: "Icons library",
              component: CoreUIIcons,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "brands",
              name: "Brands",
              component: Brands,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "flags",
              name: "Flags",
              component: Flags,
              meta: {
                requiresAdmin: true,
              },
            },
          ],
        },
        {
          path: "notifications",
          redirect: "/notifications/alerts",
          name: "Notifications",
          component: {
            render(c) {
              return c("router-view");
            },
          },
          children: [
            {
              path: "alerts",
              name: "Alerts",
              component: Alerts,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "badge",
              name: "Badge",
              component: Badges,
              meta: {
                requiresAdmin: true,
              },
            },
            {
              path: "modals",
              name: "Modals",
              component: Modals,
              meta: {
                requiresAdmin: true,
              },
            },
          ],
        },
      ],
    },
    {
      path: "/pages",
      redirect: "/pages/404",
      name: "Pages",
      component: {
        render(c) {
          return c("router-view");
        },
      },
      children: [
        {
          path: "404",
          name: "Page404",
          component: Page404,
        },
        {
          path: "500",
          name: "Page500",
          component: Page500,
        },
      ],
    },
    {
      path: "/",
      redirect: "/login",
      name: "Auth",
      component: {
        render(c) {
          return c("router-view");
        },
      },
      children: [
        {
          path: "login",
          name: "Login",
          component: Login,
        },
      ],
    },

    {
      path: "*",
      name: "404",
      component: Page404,
    },
  ];
}
