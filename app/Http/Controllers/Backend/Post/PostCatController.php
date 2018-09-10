<?php

namespace App\Http\Controllers\Backend\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post\Post;
use App\Models\Post\Postcat;
use App\Models\Post\Postmeta;
use App\Models\Cat_relation;

class PostCatController extends Controller
{
    /*
     * get all category list
     * and display in ul li
     * or simple list
     */
    public function getCategoryList($cattype="",$list="", $sel="")
    {
        $parents = $this->getParent($cattype);
        foreach($parents as $p)
        {//echo $p->id;exit;
            $subCat = $this->hasChild($p->id);
            if($subCat!==false)
                $categories[] = array('id' => $p->id, 'name' => $p->name, 'subcategory' => $subCat);
            else
                $categories[] = array('id' => $p->id, 'name' => $p->name);
        }

        if($list=="li")
        {
            $output="";
            if(!empty($categories))
            {//print_r($categories);exit;
                $output .= '<ul>';
                $output .= $this->getCategoryLi($categories, $sel);
                $output .= '</ul>';
            }
            //echo $output;exit;
            return $output;
        }
        else
            return $categories;
    }

    /*
     * get all parent list
     */
    public function getParent($cattype="")
    {
        return Postcat::where('type', '=', $cattype)
            ->where('parent', '=', '0')
            ->get();
    }

    /*
     * get child categories if available
     */
    public function hasChild($id)
    {
        $categories = Postcat::where('parent', '=', $id)->get();
        if($categories->isNotEmpty())
        {//print_r($categories);exit;
            foreach($categories as $category)
            {
                $subCat = $this->hasChild($category->id);
                if($subCat!==false)
                    $cat[] = array('id' => $category->id, 'name' => $category->name, 'subcategory' => $subCat);
                else
                    $cat[] = array('id' => $category->id, 'name' => $category->name);
            }
            return $cat;
        }
        else
            return false;
    }

    /*
     * display categories and sub categories with checkbox
     *
     */
    public function getCategoryLi($categories, $sel="")
    {
        $output = "";
        if(!empty($categories))
        {//echo "herer ";print_r($categories);exit;
            //echo "ksdjhfksjdf";print_r($sel);exit;
            foreach($categories as $cat)
            {
                if($sel!="")
                {

                    if(in_array($cat['id'], $sel))
                        $output .='<li><label><input type="checkbox" name="category[]" checked value="'.$cat['id'].'"></label> '.$cat['name'];
                    else
                        $output .='<li><label><input type="checkbox" name="category[]" value="'.$cat['id'].'"></label> '.$cat['name'];
                }
                else
                    $output .='<li><label><input type="checkbox" name="category[]" value="'.$cat['id'].'"></label> '.$cat['name'];
                if(!empty($cat['subcategory']))
                { //print_r($cat['subcategory']);exit;
                    $output .='<ul>';
                    $output .=$this->getCategoryLi($cat['subcategory'], $sel);
                    $output .='</ul></li>';
                }
                else
                    $output .= '</li>';
            }
        }
        //echo $output;exit;
        return $output;
    }
}
