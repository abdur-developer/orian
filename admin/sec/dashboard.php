<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 10px;
    }

    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 0;
    }

    /* Cards */
    .stats-card {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
        transition: all 0.3s;
        border-left: 4px solid var(--primary-color);
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
    }

    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .card-icon.users {
        background-color: rgba(76, 201, 240, 0.1);
        color: var(--success-color);
    }

    .card-icon.services {
        background-color: rgba(248, 150, 30, 0.1);
        color: var(--warning-color);
    }

    .card-icon.revenue {
        background-color: rgba(72, 149, 239, 0.1);
        color: var(--accent-color);
    }

    .card-icon.visitors {
        background-color: rgba(247, 37, 133, 0.1);
        color: var(--danger-color);
    }

    .card-title {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .card-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 5px;
    }

    .card-change {
        font-size: 12px;
        display: flex;
        align-items: center;
    }

    .card-change.positive {
        color: #28a745;
    }

    .card-change.negative {
        color: #dc3545;
    }

    /* Recent Activity */
    .activity-card {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
        margin-bottom: 25px;
    }

    .activity-item {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(67, 97, 238, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: var(--primary-color);
        flex-shrink: 0;
    }

    .activity-details {
        flex: 1;
        min-width: 0;
    }

    .activity-title {
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--dark-color);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .activity-desc {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 14px;
        color: #6c757d;
    }

    .activity-time {
        font-size: 12px;
        color: #6c757d;
    }
    /* Responsive Styles */
    @media (max-width: 1199.98px) {
        .card-value {
            font-size: 20px;
        }
    }

    @media (max-width: 767.98px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .breadcrumb {
            margin-top: 10px;
        }

        .activity-item {
            flex-direction: column;
        }

        .activity-icon {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .activity-title, .activity-desc {
            white-space: normal;
        }
    }

    @media (max-width: 575.98px) {
        .stats-card {
            padding: 15px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }

        .card-value {
            font-size: 18px;
        }

        .page-title {
            font-size: 20px;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
        animation: fadeIn 0.5s ease forwards;
    }
</style>

<div class="page-header">
    <h1 class="page-title">Dashboard Overview</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="row">
    <div class="col-md-6 col-lg-3 fade-in" style="animation-delay: 0.1s;">
        <div class="stats-card">
            <div class="card-icon users">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-title">Total Users</div>
            <div class="card-value">1,254</div>
            <div class="card-change positive">
                <i class="fas fa-arrow-up"></i> 12.5% from last month
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 fade-in" style="animation-delay: 0.2s;">
        <div class="stats-card">
            <div class="card-icon services">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <div class="card-title">Active Services</div>
            <div class="card-value">48</div>
            <div class="card-change positive">
                <i class="fas fa-arrow-up"></i> 3 new this week
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 fade-in" style="animation-delay: 0.3s;">
        <div class="stats-card">
            <div class="card-icon revenue">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-title">Total Revenue</div>
            <div class="card-value">$24,560</div>
            <div class="card-change positive">
                <i class="fas fa-arrow-up"></i> 8.2% from last quarter
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 fade-in" style="animation-delay: 0.4s;">
        <div class="stats-card">
            <div class="card-icon visitors">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="card-title">Monthly Visitors</div>
            <div class="card-value">12,458</div>
            <div class="card-change negative">
                <i class="fas fa-arrow-down"></i> 2.1% from last month
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8 fade-in" style="animation-delay: 0.5s;">
        <div class="activity-card">
            <h5 class="mb-4">Recent Activities</h5>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="activity-details">
                    <div class="activity-title">New user registered</div>
                    <div class="activity-desc">John Smith has created an account</div>
                    <div class="activity-time">10 minutes ago</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-tree"></i>
                </div>
                <div class="activity-details">
                    <div class="activity-title">Course added</div>
                    <div class="activity-desc">New course on environmental science added</div>
                    <div class="activity-time">2 hours ago</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="activity-details">
                    <div class="activity-title">Service request</div>
                    <div class="activity-desc">New maintenance request for street lights</div>
                    <div class="activity-time">5 hours ago</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-comment-dollar"></i>
                </div>
                <div class="activity-details">
                    <div class="activity-title">Payment received</div>
                    <div class="activity-desc">$250 payment for property tax</div>
                    <div class="activity-time">1 day ago</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 fade-in" style="animation-delay: 0.6s;">
        <div class="activity-card">
            <h5 class="mb-4">Quick Actions</h5>

            <button class="btn btn-primary w-100 mb-3">
                <i class="fas fa-plus-circle mr-2"></i> Add New Service
            </button>

            <button class="btn btn-outline-primary w-100 mb-3">
                <i class="fas fa-tree mr-2"></i> Add New Course
            </button>

            <button class="btn btn-outline-primary w-100 mb-3">
                <i class="fas fa-user-cog mr-2"></i> Manage Users
            </button>

            <button class="btn btn-outline-primary w-100 mb-3">
                <i class="fas fa-chart-pie mr-2"></i> View Reports
            </button>

            <button class="btn btn-outline-primary w-100">
                <i class="fas fa-cog mr-2"></i> System Settings
            </button>
        </div>
    </div>
</div>