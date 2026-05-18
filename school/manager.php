<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理面板 - 校園管理系統</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-green: #10B981;
            --light-green: #D1FAE5;
            --dark-green: #047857;
            --accent-blue: #3B82F6;
            --light-text: #6B7280;
            --dark-text: #1F2937;
            --border-color: #E5E7EB;
            --border-radius: 12px;
        }

        body {
            font-family: 'PingFang TC', 'Microsoft JhengHei', 'Segoe UI', sans-serif;
            background-color: #F9FAFB;
            color: var(--dark-text);
            overflow-x: hidden;
        }

        /* ========== 頂部導航欄 ========== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--dark-green) 100%);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
        }

        .navbar-logo-icon {
            font-size: 28px;
        }

        .navbar-logo-text {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .navbar-title {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: 500;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-size: 14px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .logout-btn {
            padding: 8px 18px;
            background-color: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            border-radius: 20px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn:hover {
            background-color: white;
            color: var(--primary-green);
        }

        /* ========== 主容器布局 ========== */
        .main-container {
            margin-top: 70px;
            display: flex;
            min-height: calc(100vh - 70px);
        }

        /* ========== 側邊欄 ========== */
        .sidebar {
            width: 250px;
            background-color: white;
            border-right: 1px solid var(--border-color);
            padding: 30px 0;
            position: fixed;
            height: calc(100vh - 70px);
            overflow-y: auto;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 25px;
            color: var(--light-text);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-size: 15px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--light-green);
            color: var(--primary-green);
            border-left-color: var(--primary-green);
            font-weight: 600;
        }

        .sidebar-menu-icon {
            font-size: 20px;
        }

        /* ========== 主內容區 ========== */
        .content {
            margin-left: 250px;
            flex: 1;
            padding: 40px;
        }

        .page-title {
            font-size: 28px;
            color: var(--dark-text);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .page-subtitle {
            color: var(--light-text);
            margin-bottom: 30px;
            font-size: 14px;
        }

        /* ========== 內容區段 ========== */
        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========== 資訊卡片 ========== */
        .info-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border-left: 4px solid var(--primary-green);
        }

        .info-card-title {
            font-size: 18px;
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .info-item {
            padding: 15px;
            background-color: #F9FAFB;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .info-label {
            font-size: 12px;
            color: var(--light-text);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            color: var(--dark-text);
            font-weight: 600;
        }

        /* ========== 成績表格 ========== */
        .table-container {
            overflow-x: auto;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #F3F4F6;
            border-bottom: 2px solid var(--border-color);
        }

        th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: var(--dark-text);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        tbody tr:hover {
            background-color: #F9FAFB;
        }

        /* ========== 成績徽章 ========== */
        .score-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .score-excellent {
            background-color: #DCFCE7;
            color: #166534;
        }

        .score-good {
            background-color: #DBEAFE;
            color: #1e40af;
        }

        .score-average {
            background-color: #FEF3C7;
            color: #92400e;
        }

        .score-poor {
            background-color: #FEE2E2;
            color: #991b1b;
        }

        /* ========== 加載狀態 ========== */
        .loading {
            text-align: center;
            padding: 40px 20px;
        }

        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid var(--light-green);
            border-top-color: var(--primary-green);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-text {
            margin-top: 15px;
            color: var(--light-text);
            font-size: 14px;
        }

        /* ========== 錯誤狀態 ========== */
        .error-message {
            background-color: #FEE2E2;
            border: 1px solid #FECACA;
            color: #991b1b;
            padding: 16px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .error-icon {
            font-size: 20px;
        }

        /* ========== 空狀態 ========== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--light-text);
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .empty-text {
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* ========== 統計卡片 ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border-top: 4px solid var(--primary-green);
            text-align: center;
        }

        .stat-card h3 {
            font-size: 28px;
            color: var(--primary-green);
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-card p {
            color: var(--light-text);
            font-size: 14px;
        }

        /* ========== 響應式設計 ========== */
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
                position: static;
                display: flex;
                overflow-x: auto;
                padding: 0;
            }

            .sidebar-menu {
                display: flex;
                width: 100%;
                overflow-x: auto;
            }

            .sidebar-menu li {
                min-width: auto;
            }

            .sidebar-menu a {
                padding: 15px 20px;
                white-space: nowrap;
                border-left: none;
                border-bottom: 4px solid transparent;
            }

            .sidebar-menu a.active {
                border-bottom-color: var(--primary-green);
                border-left: none;
            }

            .content {
                margin-left: 0;
                padding: 25px 15px;
            }

            .page-title {
                font-size: 22px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 0 20px;
            }

            .navbar-logo-text {
                display: none;
            }

            .navbar-title {
                display: none;
            }

            .navbar-right {
                gap: 10px;
            }

            .logout-btn {
                padding: 6px 12px;
                font-size: 12px;
            }

            .user-info {
                font-size: 12px;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .content {
                padding: 20px 12px;
            }

            .page-title {
                font-size: 18px;
            }

            .info-card {
                padding: 20px;
            }

            th {
                padding: 12px 8px;
                font-size: 12px;
            }

            td {
                padding: 10px 8px;
                font-size: 12px;
            }

            .stat-card h3 {
                font-size: 24px;
            }

            .navbar-logo-icon {
                font-size: 24px;
            }

            .user-info {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- 導航欄 -->
    <nav class="navbar">
        <div class="navbar-left">
            <a href="index.html" class="navbar-logo">
                <span class="navbar-logo-icon">🎓</span>
                <span class="navbar-logo-text">校園管理</span>
            </a>
            <span class="navbar-title">管理面板</span>
        </div>
        <div class="navbar-right">
            <div class="user-info">
                <div class="user-avatar">👤</div>
                <div id="userName">用戶</div>
            </div>
            <a href="javascript:void(0)" class="logout-btn">登出</a>
        </div>
    </nav>

    <!-- 主容器 -->
    <div class="main-container">
        <!-- 側邊欄 -->
        <aside class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="#" class="menu-item active" data-section="profile">
                    <span class="sidebar-menu-icon">👤</span>
                    我的資料
                </a></li>
                <li><a href="#" class="menu-item" data-section="class">
                    <span class="sidebar-menu-icon">👥</span>
                    班級資訊
                </a></li>
                <li><a href="#" class="menu-item" data-section="scores">
                    <span class="sidebar-menu-icon">📊</span>
                    成績查詢
                </a></li>
                <li><a href="#" class="menu-item" data-section="dashboard">
                    <span class="sidebar-menu-icon">📈</span>
                    學習統計
                </a></li>
            </ul>
        </aside>

        <!-- 主內容區 -->
        <main class="content">
            <!-- 我的資料 -->
            <section id="profile" class="content-section active">
                <div class="page-title">👤 我的資料</div>
                <p class="page-subtitle">查看和管理您的個人資訊</p>

                <div id="profileLoading" class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">正在載入資料...</p>
                </div>

                <div id="profileContent" style="display: none;">
                    <div class="info-card">
                        <div class="info-card-title">📋 個人基本資訊</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">帳號</div>
                                <div class="info-value" id="cdkey">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">電子郵件</div>
                                <div class="info-value" id="email">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">電話</div>
                                <div class="info-value" id="tel">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">出生日期</div>
                                <div class="info-value" id="birth">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-title">🎓 學籍資訊</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">學號</div>
                                <div class="info-value" id="schoolNum">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">班級</div>
                                <div class="info-value" id="className">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">科系</div>
                                <div class="info-value" id="deptName">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">入學年份</div>
                                <div class="info-value" id="enrollYear">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="profileError" style="display: none;"></div>
            </section>

            <!-- 班級資訊 -->
            <section id="class" class="content-section">
                <div class="page-title">👥 班級資訊</div>
                <p class="page-subtitle">查看您所在班級的資訊和成員</p>

                <div id="classLoading" class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">正在載入資料...</p>
                </div>

                <div id="classContent" style="display: none;">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h3 id="classMemberCount">0</h3>
                            <p>班級人數</p>
                        </div>
                        <div class="stat-card">
                            <h3 id="classTeacher">-</h3>
                            <p>班導師</p>
                        </div>
                    </div>

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>學號</th>
                                    <th>姓名</th>
                                    <th>性別</th>
                                    <th>出生日期</th>
                                    <th>聯繫電話</th>
                                </tr>
                            </thead>
                            <tbody id="classTableBody">
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px;">載入中...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="classError" style="display: none;"></div>
            </section>

            <!-- 成績查詢 -->
            <section id="scores" class="content-section">
                <div class="page-title">📊 成績查詢</div>
                <p class="page-subtitle">查看您的各科成績和平均分</p>

                <div id="scoresLoading" class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">正在載入資料...</p>
                </div>

                <div id="scoresContent" style="display: none;">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h3 id="avgScore">0</h3>
                            <p>平均分數</p>
                        </div>
                        <div class="stat-card">
                            <h3 id="totalCourses">0</h3>
                            <p>科目數量</p>
                        </div>
                        <div class="stat-card">
                            <h3 id="highestScore">0</h3>
                            <p>最高分數</p>
                        </div>
                        <div class="stat-card">
                            <h3 id="lowestScore">0</h3>
                            <p>最低分數</p>
                        </div>
                    </div>

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>科目代碼</th>
                                    <th>科目名稱</th>
                                    <th>學分</th>
                                    <th>分數</th>
                                    <th>等級</th>
                                </tr>
                            </thead>
                            <tbody id="scoresTableBody">
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px;">載入中...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="scoresError" style="display: none;"></div>
            </section>

            <!-- 學習統計 -->
            <section id="dashboard" class="content-section">
                <div class="page-title">📈 學習統計</div>
                <p class="page-subtitle">您的學習進度和成績概覽</p>

                <div class="stats-grid">
                    <div class="stat-card">
                        <h3 id="passCount">0</h3>
                        <p>及格科目</p>
                    </div>
                    <div class="stat-card">
                        <h3 id="failCount">0</h3>
                        <p>不及格科目</p>
                    </div>
                    <div class="stat-card">
                        <h3 id="totalCredits">0</h3>
                        <p>總學分</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-title">📊 成績分布</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">優秀 (90-100)</div>
                            <div class="info-value" id="excellentCount">0</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">良好 (80-89)</div>
                            <div class="info-value" id="goodCount">0</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">及格 (60-79)</div>
                            <div class="info-value" id="passLevelCount">0</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">不及格 (<60)</div>
                            <div class="info-value" id="failLevelCount">0</div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // 菜單點擊事件
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // 移除所有 active 狀態
                document.querySelectorAll('.menu-item').forEach(m => m.classList.remove('active'));
                document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
                
                // 添加新的 active 狀態
                this.classList.add('active');
                const sectionId = this.getAttribute('data-section');
                document.getElementById(sectionId).classList.add('active');
                
                // 加載數據
                if (sectionId === 'profile') loadProfile();
                else if (sectionId === 'class') loadClass();
                else if (sectionId === 'scores') loadScores();
                else if (sectionId === 'dashboard') loadDashboard();
            });
        });

        // 獲取用戶信息
        function getUserCdkey() {
            const cdkey = localStorage.getItem('userCdkey');
            if (cdkey) {
                document.getElementById('userName').textContent = cdkey;
            }
            return cdkey;
        }

        // 加載個人資料
        function loadProfile() {
            const cdkey = getUserCdkey();
            if (!cdkey) {
                showError('profile', '未找到用戶信息，請重新登入');
                return;
            }

            const profileContent = document.getElementById('profileContent');
            const profileLoading = document.getElementById('profileLoading');
            const profileError = document.getElementById('profileError');
            
            profileContent.style.display = 'none';
            profileLoading.style.display = 'block';
            profileError.style.display = 'none';

            fetch('manager-api.php?action=profile&cdkey=' + encodeURIComponent(cdkey))
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const profile = data.data;
                        document.getElementById('cdkey').textContent = profile.cdkey;
                        document.getElementById('email').textContent = profile.email || '-';
                        document.getElementById('tel').textContent = profile.tel || '-';
                        document.getElementById('birth').textContent = profile.birth || '-';
                        document.getElementById('schoolNum').textContent = profile.school_num || '-';
                        document.getElementById('className').textContent = profile.class_name || '-';
                        document.getElementById('deptName').textContent = profile.dept_name || '-';
                        document.getElementById('enrollYear').textContent = profile.enroll_year || '-';

                        profileLoading.style.display = 'none';
                        profileContent.style.display = 'block';
                    } else {
                        throw new Error(data.message);
                    }
                })
                .catch(error => {
                    showError('profile', '載入失敗：' + error.message);
                });
        }

        // 加載班級資訊
        function loadClass() {
            const cdkey = getUserCdkey();
            if (!cdkey) {
                showError('class', '未找到用戶信息，請重新登入');
                return;
            }

            const classContent = document.getElementById('classContent');
            const classLoading = document.getElementById('classLoading');
            const classError = document.getElementById('classError');
            
            classContent.style.display = 'none';
            classLoading.style.display = 'block';
            classError.style.display = 'none';

            fetch('manager-api.php?action=class&cdkey=' + encodeURIComponent(cdkey))
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const classData = data.data;
                        document.getElementById('classMemberCount').textContent = classData.members.length;
                        document.getElementById('classTeacher').textContent = classData.teacher || '-';

                        const tbody = document.getElementById('classTableBody');
                        tbody.innerHTML = '';
                        
                        if (classData.members.length > 0) {
                            classData.members.forEach(member => {
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                    <td>${member.school_num}</td>
                                    <td>${member.name}</td>
                                    <td>${member.gender === 'M' ? '男' : member.gender === 'F' ? '女' : '-'}</td>
                                    <td>${member.birth || '-'}</td>
                                    <td>${member.phone || '-'}</td>
                                `;
                                tbody.appendChild(tr);
                            });
                        } else {
                            tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; padding: 40px;">暫無班級成員資訊</td></tr>';
                        }

                        classLoading.style.display = 'none';
                        classContent.style.display = 'block';
                    } else {
                        throw new Error(data.message);
                    }
                })
                .catch(error => {
                    showError('class', '載入失敗：' + error.message);
                });
        }

        // 加載成績信息
        function loadScores() {
            const cdkey = getUserCdkey();
            if (!cdkey) {
                showError('scores', '未找到用戶信息，請重新登入');
                return;
            }

            const scoresContent = document.getElementById('scoresContent');
            const scoresLoading = document.getElementById('scoresLoading');
            const scoresError = document.getElementById('scoresError');
            
            scoresContent.style.display = 'none';
            scoresLoading.style.display = 'block';
            scoresError.style.display = 'none';

            fetch('manager-api.php?action=scores&cdkey=' + encodeURIComponent(cdkey))
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const scores = data.data;
                        document.getElementById('avgScore').textContent = scores.average ? scores.average.toFixed(1) : '0';
                        document.getElementById('totalCourses').textContent = scores.courses.length;
                        document.getElementById('highestScore').textContent = scores.highest || '0';
                        document.getElementById('lowestScore').textContent = scores.lowest || '0';

                        const tbody = document.getElementById('scoresTableBody');
                        tbody.innerHTML = '';
                        
                        if (scores.courses.length > 0) {
                            scores.courses.forEach(course => {
                                const score = course.score || 0;
                                let scoreClass = 'score-poor';
                                if (score >= 90) scoreClass = 'score-excellent';
                                else if (score >= 80) scoreClass = 'score-good';
                                else if (score >= 60) scoreClass = 'score-average';

                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                    <td>${course.course_code || '-'}</td>
                                    <td>${course.course_name || '-'}</td>
                                    <td>${course.credit || '-'}</td>
                                    <td><span class="score-badge ${scoreClass}">${score}</span></td>
                                    <td>${score >= 60 ? '及格' : '不及格'}</td>
                                `;
                                tbody.appendChild(tr);
                            });
                        } else {
                            tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; padding: 40px;">暫無成績資訊</td></tr>';
                        }

                        scoresLoading.style.display = 'none';
                        scoresContent.style.display = 'block';
                    } else {
                        throw new Error(data.message);
                    }
                })
                .catch(error => {
                    showError('scores', '載入失敗：' + error.message);
                });
        }

        // 加載學習統計
        function loadDashboard() {
            const cdkey = getUserCdkey();
            if (!cdkey) {
                return;
            }

            fetch('manager-api.php?action=scores&cdkey=' + encodeURIComponent(cdkey))
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const scores = data.data;
                        
                        let passCount = 0, failCount = 0;
                        let excellentCount = 0, goodCount = 0, passLevelCount = 0, failLevelCount = 0;
                        let totalCredits = 0;

                        scores.courses.forEach(course => {
                            const score = course.score || 0;
                            const credit = parseInt(course.credit) || 0;

                            if (score >= 60) {
                                passCount++;
                                totalCredits += credit;
                            } else {
                                failCount++;
                            }

                            if (score >= 90) excellentCount++;
                            else if (score >= 80) goodCount++;
                            else if (score >= 60) passLevelCount++;
                            else failLevelCount++;
                        });

                        document.getElementById('passCount').textContent = passCount;
                        document.getElementById('failCount').textContent = failCount;
                        document.getElementById('totalCredits').textContent = totalCredits;
                        document.getElementById('excellentCount').textContent = excellentCount;
                        document.getElementById('goodCount').textContent = goodCount;
                        document.getElementById('passLevelCount').textContent = passLevelCount;
                        document.getElementById('failLevelCount').textContent = failLevelCount;
                    }
                })
                .catch(error => {
                    console.error('統計加載失敗', error);
                });
        }

        // 顯示錯誤信息
        function showError(section, message) {
            const errorDiv = document.getElementById(section + 'Error');
            const loadingDiv = document.getElementById(section + 'Loading');
            const contentDiv = document.getElementById(section + 'Content');
            
            if (errorDiv) {
                errorDiv.innerHTML = `
                    <div class="error-message">
                        <span class="error-icon">⚠️</span>
                        <span>${message}</span>
                    </div>
                `;
                errorDiv.style.display = 'block';
                if (loadingDiv) loadingDiv.style.display = 'none';
                if (contentDiv) contentDiv.style.display = 'none';
            }
        }

        // 頁面載入時
        window.addEventListener('load', function() {
            getUserCdkey();
            loadProfile();
        });

        // 用戶登出
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.querySelector('.logout-btn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    if (confirm('確定要登出嗎？')) {
                        localStorage.removeItem('userCdkey');
                        window.location.href = 'index.html';
                    }
                });
            }
        });
    </script>
</body>
</html>
