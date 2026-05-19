<?php
include_once "db_conn.php";

// Fetch departments for 科別 select
$depts = [];
try {
    $depts = $pdo->query("SELECT * FROM `dept` ORDER BY `code` ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Fallback if query fails
}

// Fetch graduate schools for 畢業國中 select
$schools = [];
try {
    $schools = $pdo->query("SELECT * FROM `graduate_school` ORDER BY `county` ASC, `name` ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Fallback if query fails
}

// Fetch graduation statuses for 畢業狀態 select
$statuses = [];
try {
    $statuses = $pdo->query("SELECT * FROM `status` ORDER BY `code` ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Fallback if query fails
}

// Get classroom code if passed from previous page
$class_code = isset($_GET['code']) ? $_GET['code'] : '';
?>

<style>
/* Scoped form styles to prevent polluting admin.php styles and avoid nav bar misalignment */
.add-student-wrapper {
    max-width: 850px;
    margin: 20px auto;
    padding: 0 10px;
}

.add-student-btn-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #2e7d32;
    text-decoration: none;
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.add-student-btn-back:hover {
    color: #ff9800;
    transform: translateX(-4px);
}

.add-student-card {
    background-color: #f1f8f5;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    border-left: 5px solid #ff9800;
}

.add-student-header {
    text-align: center;
    margin-bottom: 35px;
    position: relative;
    padding-bottom: 15px;
}

.add-student-header h1 {
    color: #2e7d32;
    font-size: 28px;
    margin-bottom: 8px;
    font-weight: bold;
}

.add-student-header p {
    color: #ff9800;
    font-size: 14px;
    font-weight: 500;
}

.add-student-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background-color: #ff9800;
    border-radius: 2px;
}

/* 2-Column Responsive Grid Layout */
.add-student-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}

.add-student-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

/* Make address input span full width */
.add-student-group.full-width {
    grid-column: span 2;
}

.add-student-label {
    color: #2e7d32;
    font-weight: bold;
    font-size: 14px;
}

.add-student-label .required-star {
    color: #ff5252;
    margin-left: 4px;
}

.add-student-input,
.add-student-select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #a5d6a7;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #ffffff;
    color: #333;
    box-sizing: border-box;
}

.add-student-input:focus,
.add-student-select:focus {
    outline: none;
    border-color: #ff9800;
    box-shadow: 0 0 8px rgba(255, 152, 0, 0.15);
    background-color: #fffde7;
}

.add-student-input::placeholder {
    color: #a5d6a7;
}

/* Custom styled dropdown menu with matching green arrow */
.add-student-select {
    appearance: none;
    background-image: url("data:image/svg+xml;utf8,<svg fill='%232e7d32' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 38px;
    cursor: pointer;
}

.add-student-select:focus {
    background-image: url("data:image/svg+xml;utf8,<svg fill='%23ff9800' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
}

.add-student-actions {
    display: flex;
    gap: 15px;
    margin-top: 35px;
    grid-column: span 2;
}

.add-student-btn {
    flex: 1;
    padding: 14px 20px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.add-student-btn-submit {
    background-color: #ff9800;
    color: white;
}

.add-student-btn-submit:hover {
    background-color: #f57c00;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
}

.add-student-btn-reset {
    background-color: #c8e6c9;
    color: #2e7d32;
    border: 2px solid #a5d6a7;
}

.add-student-btn-reset:hover {
    background-color: #a5d6a7;
    color: white;
    transform: translateY(-2px);
}

.add-student-footer-tips {
    text-align: center;
    color: #888;
    font-size: 12px;
    margin-top: 25px;
    grid-column: span 2;
}

/* Responsive styles */
@media (max-width: 768px) {
    .add-student-grid {
        grid-template-columns: 1fr;
        gap: 18px;
    }
    .add-student-group.full-width,
    .add-student-actions,
    .add-student-footer-tips {
        grid-column: span 1;
    }
    .add-student-card {
        padding: 25px 20px;
    }
}
</style>

<div class="add-student-wrapper">
    <!-- Back Navigation Link with Class Code Parameter -->
    <?php if (!empty($class_code)): ?>
        <a href="?inc=class_students&code=<?= htmlspecialchars($class_code) ?>" class="add-student-btn-back">
            <span>⬅</span> 返回班級學生列表
        </a>
    <?php else: ?>
        <a href="?inc=classrooms" class="add-student-btn-back">
            <span>⬅</span> 返回班級列表
        </a>
    <?php endif; ?>

    <div class="add-student-card">
        <div class="add-student-header">
            <h1>新增學生</h1>
            <p>✨ 建立翠園高中學生學籍檔案 ✨</p>
        </div>

        <form action="api_add_student.php" method="post">
            <!-- Hidden classroom code input to persist class association -->
            <input type="hidden" name="class_code" value="<?= htmlspecialchars($class_code) ?>">

            <div class="add-student-grid">
                
                <!-- 學號 (school_num) -> input number -->
                <div class="add-student-group">
                    <label for="school_num" class="add-student-label">學號<span class="required-star">*</span></label>
                    <input 
                        type="number" 
                        id="school_num" 
                        name="school_num" 
                        class="add-student-input" 
                        placeholder="請輸入6位數學號" 
                        min="100000" 
                        max="999999" 
                        required
                    >
                </div>

                <!-- 姓名 (name) -> input text -->
                <div class="add-student-group">
                    <label for="name" class="add-student-label">姓名<span class="required-star">*</span></label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="add-student-input" 
                        placeholder="請輸入學生姓名" 
                        maxlength="8" 
                        required
                    >
                </div>

                <!-- 出生年月日 (birthday) -> input date -->
                <div class="add-student-group">
                    <label for="birthday" class="add-student-label">出生年月日<span class="required-star">*</span></label>
                    <input 
                        type="date" 
                        id="birthday" 
                        name="birthday" 
                        class="add-student-input" 
                        required
                    >
                </div>

                <!-- 身分證字號 (uni_id) -> input uni_id -->
                <div class="add-student-group">
                    <label for="uni_id" class="add-student-label">身分證字號<span class="required-star">*</span></label>
                    <input 
                        type="text" 
                        id="uni_id" 
                        name="uni_id" 
                        class="add-student-input" 
                        placeholder="請輸入身分證字號 (如: A123456789)" 
                        pattern="[A-Z][1-2][0-9]{8}" 
                        title="請輸入正確的中華民國身分證字號，例如 A123456789" 
                        required
                    >
                </div>

                <!-- 住址 (addr) -> input addr -->
                <div class="add-student-group full-width">
                    <label for="addr" class="add-student-label">住址<span class="required-star">*</span></label>
                    <input 
                        type="text" 
                        id="addr" 
                        name="addr" 
                        class="add-student-input" 
                        placeholder="請輸入通訊住址" 
                        maxlength="32" 
                        required
                    >
                </div>

                <!-- 家長 (parents) -> input text -->
                <div class="add-student-group">
                    <label for="parents" class="add-student-label">家長姓名<span class="required-star">*</span></label>
                    <input 
                        type="text" 
                        id="parents" 
                        name="parents" 
                        class="add-student-input" 
                        placeholder="請輸入主要聯絡家長" 
                        maxlength="8" 
                        required
                    >
                </div>

                <!-- 電話 (tel) -> input num -->
                <div class="add-student-group">
                    <label for="tel" class="add-student-label">聯絡電話<span class="required-star">*</span></label>
                    <input 
                        type="text" 
                        id="tel" 
                        name="tel" 
                        class="add-student-input" 
                        placeholder="請輸入聯絡電話" 
                        pattern="[0-9\-]*" 
                        title="請輸入數字或含有-的電話號碼" 
                        required
                    >
                </div>

                <!-- 科別 (dept) -> select -->
                <div class="add-student-group">
                    <label for="dept" class="add-student-label">科別<span class="required-star">*</span></label>
                    <select id="dept" name="dept" class="add-student-select" required>
                        <option value="" disabled selected>-- 請選擇科別 --</option>
                        <?php foreach ($depts as $dept): ?>
                            <option value="<?= $dept['id'] ?>">
                                <?= htmlspecialchars($dept['name']) ?> (<?= htmlspecialchars($dept['code']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- 畢業國中 (graduate_at) -> select -->
                <div class="add-student-group">
                    <label for="graduate_at" class="add-student-label">畢業國中<span class="required-star">*</span></label>
                    <select id="graduate_at" name="graduate_at" class="add-student-select" required>
                        <option value="" disabled selected>-- 請選擇畢業國中 --</option>
                        <?php foreach ($schools as $school): ?>
                            <option value="<?= $school['id'] ?>">
                                [<?= htmlspecialchars($school['county']) ?>] <?= htmlspecialchars($school['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- 畢業狀態 (status_code) -> select -->
                <div class="add-student-group full-width">
                    <label for="status_code" class="add-student-label">畢業狀態<span class="required-star">*</span></label>
                    <select id="status_code" name="status_code" class="add-student-select" required>
                        <option value="" disabled selected>-- 請選擇畢業狀態 --</option>
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?= $status['code'] ?>">
                                <?= htmlspecialchars($status['status']) ?> - <?= htmlspecialchars($status['note']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Actions Buttons -->
                <div class="add-student-actions">
                    <button type="submit" class="add-student-btn add-student-btn-submit">確認新增</button>
                    <button type="reset" class="add-student-btn add-student-btn-reset">清空欄位</button>
                </div>

                <!-- Helper Tips -->
                <div class="add-student-footer-tips">
                    * 號標示欄位為必填項目，請確保填寫內容符合格式規範。
                </div>

            </div>
        </form>
    </div>
</div>