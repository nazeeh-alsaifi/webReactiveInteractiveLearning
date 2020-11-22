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

// activity
const ActivityIndex = () => import("@/views/activity/ActivityIndex");

// coordinator
const CoordinatorSubjects = () => import("@/views/coordinator/MySubjects");
const CoordinatorSubjectsClasses = () => import("@/views/coordinator/Classes");
const SubjectClass = () => import("@/views/coordinator/Class");
const CoordinatorTeachers = () => import("@/views/coordinator/MyTeachers");
const TeacherClasses = () => import("@/views/coordinator/TeacherClasses");

// subject coordinator
const SubjectCoordinatorTeachers = () =>
  import("@/views/subjectCoordinator/MyTeachers");
const SubjectCoordinatorTeacherClasses = () =>
  import("@/views/subjectCoordinator/Classes");
const SubjectCoordinatorClass = () =>
  import("@/views/subjectCoordinator/Class");

//teacher
const MyTeacherClasses = () => import("@/views/teacher/TeacherClasses");
const MyTeacherClass = () => import("@/views/teacher/Class");

// permissions
const PermissionsIndex = () => import("@/views/permissions/PermissionsIndex");

// join class
const JoinClass = () => import("@/views/joinClass/JoinClassIndex");
const JoinEditCoordinator = () =>
  import("@/views/joinClass/joinEditCoordinator");
const AddTeacher = () => import("@/views/joinClass/addTeacher");

const JoinEditTeacher = () => import("@/views/joinClass/joinEditTeacher");
const AddClass = () => import("@/views/joinClass/addClass");

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
                  path: "addClasses",
                  name: "Add Classes",
                  component: AddClass,
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
            requiresUser: true,
          },
        },
        {
          path: "typography",
          name: "Typography",
          component: Typography,
          meta: {
            requiresUser: true,
          },
        },
        {
          path: "charts",
          name: "Charts",
          component: Charts,
          meta: {
            requiresUser: true,
          },
        },
        {
          path: "widgets",
          name: "Widgets",
          component: Widgets,
          meta: {
            requiresUser: true,
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
              path: ":id/classes",
              meta: { label: "classes" },
              //component: CoordinatorSubjectsClasses,
              //meta: {
              //  requiresCoordinator: true,
              //},
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
                  path: ":id/myclass",
                  name: "class",
                  component: SubjectClass,
                  meta: {
                    requiresCoordinator: true,
                  },
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
              path: ":id/teacherclasses",
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
                  path: ":id/myclass",
                  name: "class",
                  component: SubjectClass,
                  meta: {
                    requiresCoordinator: true,
                  },
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
              path: ":id/teacherclasses",
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
                  path: ":id/myclass",
                  name: "class",
                  component: SubjectCoordinatorClass,
                  meta: {
                    requiresSubjectCoordinator: true,
                  },
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
              name: "class",
              component: MyTeacherClass,
              meta: {
                requiresTeacher: true,
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
            requiresStudent_FreeStudent: true,
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
          path: "activity-student",
          name: "Activity",
          component: ActivityIndex,
          meta: {
            requiresStudent_FreeStudent: true,
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
                requiresUser: true,
              },
            },
            {
              path: "forms",
              name: "Forms",
              component: Forms,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "switches",
              name: "Switches",
              component: Switches,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "tables",
              name: "Tables",
              component: Tables,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "tabs",
              name: "Tabs",
              component: Tabs,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "breadcrumb",
              name: "Breadcrumb",
              component: Breadcrumbs,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "carousel",
              name: "Carousel",
              component: Carousels,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "collapse",
              name: "Collapse",
              component: Collapses,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "jumbotron",
              name: "Jumbotron",
              component: Jumbotrons,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "list-group",
              name: "List Group",
              component: ListGroups,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "navs",
              name: "Navs",
              component: Navs,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "navbars",
              name: "Navbars",
              component: Navbars,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "pagination",
              name: "Pagination",
              component: Paginations,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "popovers",
              name: "Popovers",
              component: Popovers,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "progress",
              name: "Progress",
              component: ProgressBars,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "tooltips",
              name: "Tooltips",
              component: Tooltips,
              meta: {
                requiresUser: true,
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
                requiresUser: true,
              },
            },
            {
              path: "button-group",
              name: "Button Group",
              component: ButtonGroups,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "dropdowns",
              name: "Dropdowns",
              component: Dropdowns,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "brand-buttons",
              name: "Brand Buttons",
              component: BrandButtons,
              meta: {
                requiresUser: true,
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
                requiresUser: true,
              },
            },
            {
              path: "brands",
              name: "Brands",
              component: Brands,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "flags",
              name: "Flags",
              component: Flags,
              meta: {
                requiresUser: true,
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
                requiresUser: true,
              },
            },
            {
              path: "badge",
              name: "Badge",
              component: Badges,
              meta: {
                requiresUser: true,
              },
            },
            {
              path: "modals",
              name: "Modals",
              component: Modals,
              meta: {
                requiresUser: true,
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
