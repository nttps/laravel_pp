<?php

namespace NttpDev\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['parent_id' , 'name' , 'slug' , 'image' , 'meta_title' , 'meta_keyword' , 'meta_description' , 'enable_home' , 'enable_banner'];

    public function parent()
    {
        return $this->belongsTo('NttpDev\Model\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('NttpDev\Model\Category', 'parent_id');
    }
    public function section() {
        return $this->belongsTo('NttpDev\Model\Category');
    }
    public function products()
    {
        return $this->belongsToMany('NttpDev\Model\Product' , 'category_products');
    }

    public function brands()
    {
        return $this->belongsToMany('NttpDev\Model\Product' , 'category_products');
    }
    public function getParentCategoryNameAttribute()
    {
    	return ($this->parent == null)
    		? ''
    		: $this->parent->name;
    }
    function getUrlSlugParent()
    {
        $slugs = '';
        if($this->parent){
            $parents = $this->parents->sortBy('parent_id');
            foreach($parents as $key=> $parent){
                reset($parents);
                $slugs .= $parent->slug.'/';
               

                end($parents);
                if ($key == key($parents)){            
                    $slugs .= $this->slug.'/';
                }
            }
            
            
        }else{
            $slugs .= $this->slug;
        }
        
        // let's check if the slugs from the database hierarchy match the URL slugs
        return $slugs;
        
    }
    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;
    
        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }
    
        return $parents;
    }
    public function getChildrensAttribute()
    {
        $childrens = collect([]);

        $children = $this->children;

        while(!is_null($children)) {
            $childrens->push($children);
            $children = $children->children;
        }

        return $childrens;
    }
}
