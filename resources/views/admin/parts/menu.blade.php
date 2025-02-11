<?php
    use Illuminate\Routing\Route;
?>
<ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a class="nav-link" href="<?=route('home') ?>">Main page blog</a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('admin.index')) active @endif" href="<?=route('admin.index')?>">Main admin page</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('admin.posts.index')) active @endif" href="<?=route('admin.posts.index')?>">Posts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('admin.categories.index')) active @endif" href="<?=route('admin.categories.index')?>">Categories</a>
    </li>
</ul>
