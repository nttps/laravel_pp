<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});


// Home > [Product]
Breadcrumbs::for('product', function ($trail) {
    $trail->parent('home');
    $trail->push(__('main.word.products'), route('products.index'));
});

// Home > [Brand]
Breadcrumbs::for('brand', function ($trail) {
    $trail->parent('home');
    $trail->push(__('main.word.brands'), route('brands.index'));
});

// Home > Brand All > [Brand]
Breadcrumbs::for('brand_show', function ($trail , $brand) {
    $trail->parent('brand');
    $trail->push($brand->name, route('brands.show' , $brand->slug));
});


// Home  > [Cart]
Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('home');
    $trail->push(__('main.word.your-cart'), route('cart'));
});

// Home  > [Checkout]
Breadcrumbs::for('checkout', function ($trail) {
    $trail->parent('home');
    $trail->push(__('main.word.Checkout'), route('checkout'));
});


// Home > Product >  [Product Detail]
Breadcrumbs::for('product_detail', function ($trail, $product) {
    $trail->parent('product');
    $trail->push($product->name, route('products.show', $product->slug));
});


// Home  > [Knowledge]
Breadcrumbs::for('knowledge', function ($trail) {
    $trail->parent('home');
    $trail->push(__('main.word.knowledges'), route('knowledge.index'));
});

// Home  > Knowledge > [Detail]
Breadcrumbs::for('knowledge_detail', function ($trail , $knowledge) {
    $trail->parent('knowledge');
    $trail->push($knowledge->name, route('knowledge.show' , $knowledge->slug));
});


// Home  > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('home');
    $trail->push($category->name, route('category', $category->slug));
});


// Home > About
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('About', route('about'));
});

// Home > [Contact]
Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push(__('main.word.contact-us'), route('contact'));
});


// Home > [Promotion]
Breadcrumbs::for('promotion', function ($trail) {
    $trail->parent('home');
    $trail->push(__('main.word.promotions'), route('promotion'));
});
// Home  > Knowledge > [Detail]
Breadcrumbs::for('promotion_detail', function ($trail , $promotion) {
    $trail->parent('promotion');
    $trail->push($promotion->title, route('promotion.show' , $promotion->slug));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});