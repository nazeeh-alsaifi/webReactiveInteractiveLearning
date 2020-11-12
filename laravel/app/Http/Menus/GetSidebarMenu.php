<?php
/*
*   07.11.2019
*   MenusMenu.php
*/
namespace App\Http\Menus;

use App\MenuBuilder\MenuBuilder;
use Illuminate\Support\Facades\DB;
use App\Models\Menus;
use App\MenuBuilder\RenderFromDatabaseData;

class GetSidebarMenu implements MenuInterface{

    private $mb; //menu builder
    private $menu;

    public function __construct(){
        $this->mb = new MenuBuilder();
    }

    private function getMenuFromDB($menuName, $role){
        $this->menu = Menus::join('menu_role', 'menus.id', '=', 'menu_role.menus_id')
            ->join('menulist', 'menulist.id', '=', 'menus.menu_id')
            ->select('menus.*')
            ->where('menulist.name', '=', $menuName)
            ->where('menu_role.role_name', '=', $role)
            ->orderBy('menus.sequence', 'asc')->get();       
    }

    private function getAdminMenu($menuName){
        $this->getMenuFromDB($menuName, 'admin');
    }
    private function getUserMenu($menuName){
        $this->getMenuFromDB($menuName, 'user');
    }
    private function getGuestMenu($menuName){
        $this->getMenuFromDB($menuName, 'guest');
    }
    private function getEditorMenu($menuName){
        $this->getMenuFromDB($menuName, 'editor');
    }
    private function getCoordinatorMenu($menuName){
        $this->getMenuFromDB($menuName, 'coordinator');
    }
     private function getTeacherMenu($menuName){
        $this->getMenuFromDB($menuName, 'teacher');
    }
    private function getStudentMenu($menuName){
        $this->getMenuFromDB($menuName, 'student');
    }
    private function getFreeStudentMenu($menuName){
        $this->getMenuFromDB($menuName, 'free_student');
    }
    private function getSubjectCoordinatorMenu($menuName){
        $this->getMenuFromDB($menuName, 'free_student');
    }

    public function get($roles, $menuName = 'sidebar menu'){
        $roles = explode(',', $roles);
        if(empty($roles)){
            $this->getGuestMenu($menuName);
        }elseif(in_array('admin', $roles)){
            $this->getAdminMenu($menuName);
        }elseif(in_array('user', $roles)){
            $this->getUserMenu($menuName);
        }elseif(in_array('editor', $roles)){
            $this->getEditorMenu($menuName);
        }elseif(in_array('coordinator', $roles)){
            $this->getCoordinatorMenu($menuName);
        }elseif(in_array('teacher', $roles)){
            $this->getTeacherMenu($menuName);
        }elseif(in_array('student', $roles)){
            $this->getStudentMenu($menuName);
        }elseif(in_array('free_student', $roles)){
            $this->getFreeStudentMenu($menuName);
        }elseif(in_array('subject_coordinator', $roles)){
            $this->getSubjectCoordinatorMenu($menuName);
        }
        else{
            $this->getGuestMenu($menuName);
        }
        $rfd = new RenderFromDatabaseData;
        return $rfd->render($this->menu);
    }

    public function getAll( $menuId = 1 ){
        $this->menu = Menus::select('menus.*')
            ->where('menus.menu_id', '=', $menuId)
            ->orderBy('menus.sequence', 'asc')->get();  
        $rfd = new RenderFromDatabaseData;
        return $rfd->render($this->menu);
    }
}