<div style="display: flex; justify-content: center;">
    <a href="home" class="logo">
        <img src="images/agtech.jfif" alt="navbar brand" class="navbar-brand" height="120" />
    </a>
</div>


<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ Request::is('admindash') ? 'active' : '' }}">
        <a href="admindash" class="menu-link">
            <i class="menu-icon fas fa-tachometer-alt"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <!-- Feedback -->
    <li class="menu-item {{ Request::is('admintestimonials') ? 'active' : '' }}">
        <a href="admintestimonials" class="menu-link">
            <i class="menu-icon fas fa-comment-alt"></i>
            <div data-i18n="Without menu">Feedback</div>
        </a>
    </li>

    <!-- Announcement -->
    <li class="menu-item {{ Request::is('announcement') ? 'active' : '' }}">
        <a href="announcement" class="menu-link">
            <i class="menu-icon fas fa-bullhorn"></i>
            <div data-i18n="Without menu">Announcement</div>
        </a>
    </li>

    <!-- Farmer Crops -->
    <li class="menu-item {{ Request::is('farmersCrops') ? 'active' : '' }}">
        <a href="farmersCrops" class="menu-link">
            <i class="menu-icon fas fa-seedling"></i>
            <div data-i18n="Without navbar">Farmer Crops</div>
        </a>
    </li>

    <!-- Farmer Assistance -->
    <li class="menu-item {{ Request::is('assistance') ? 'active' : '' }}">
        <a href="assistance" class="menu-link">
            <i class="menu-icon fas fa-hands-helping"></i>
            <div data-i18n="Without navbar">Farmer Assistance</div>
        </a>
    </li>

    <!-- Calamity Report -->
    <li class="menu-item {{ Request::is('calamityReportAdmin') ? 'active' : '' }}">
        <a href="calamityReportAdmin" class="menu-link">
            <i class="menu-icon fas fa-exclamation-triangle"></i>
            <div data-i18n="Without navbar">Calamity Report</div>
        </a>
    </li>
</ul>
<style>
    .menu-inner {
    background-color: transparent; /* No background color */
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 10px;
    font-family: 'Arial', sans-serif;
}

.menu-item {
    position: relative;
    padding: 10px 20px;
    margin-bottom: 5px;
    border-radius: 5px;
    transition: transform 0.3s;
}

.menu-item:hover {
    background-color: rgba(0, 123, 255, 0.8); /* Transparent blue on hover */
    transform: scale(1.05);
}

.menu-item.active {
    color: #28a745; /* Active color for text, no background */
}

.menu-link {
    color: rgba(51, 51, 51, 0.9); /* Slightly transparent text */
    display: flex;
    align-items: center;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.menu-link i {
    margin-right: 10px;
    font-size: 1.2rem;
}

.menu-link:hover {
    color: rgba(255, 255, 255, 0.8); /* Slightly transparent white text on hover */
}

.menu-item .menu-link div {
    font-size: 14px;
}

@media (max-width: 768px) {
    .menu-inner {
        padding: 5px;
    }

    .menu-item {
        padding: 8px 15px;
    }

    .menu-link {
        font-size: 14px;
    }

    .menu-link i {
        font-size: 1.1rem;
    }
}

</style>
