<style>
    .news-container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 0 20px;
    }

    .news-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .news-header h1 {
        font-size: 28px;
        color: #333;
        margin: 0;
        font-weight: bold;
    }

    .btn-add-news {
        background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(46, 125, 50, 0.2);
    }

    .btn-add-news:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
    }

    /* 表格樣式 */
    .news-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .news-table thead {
        background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
        color: white;
    }

    .news-table th {
        padding: 16px;
        text-align: left;
        font-weight: bold;
        font-size: 14px;
    }

    .news-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #e0e0e0;
        color: #555;
        font-size: 18px;
    }

    .news-table tbody tr {
        transition: all 0.3s ease;
    }

    .news-table tbody tr:hover {
        background-color: #f5f5f5;
    }

    .news-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* 新聞ID */
    .news-id {
        font-weight: bold;
        color: #2e7d32;
    }

    /* 標題 */
    .news-subject {
        color: #1a1a1a;
        font-weight: 500;
        max-width: 250px;
        word-break: break-word;
    }

    /* 內容預覽 */
    .news-preview {
        color: #888;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* 日期 */
    .news-date {
        color: #666;
        font-size: 14px;
    }

    /* 操作按鈕組 */
    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-edit, .btn-delete {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-edit {
        background-color: #2196F3;
        color: white;
    }

    .btn-edit:hover {
        background-color: #1976D2;
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(33, 150, 243, 0.3);
    }

    .btn-delete {
        background-color: #f44336;
        color: white;
    }

    .btn-delete:hover {
        background-color: #d32f2f;
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(244, 67, 54, 0.3);
    }

    /* 空狀態 */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }

    .empty-state p {
        margin: 10px 0;
        font-size: 16px;
    }
</style>

<div class="news-container">
    <div class="news-header">
        <h1>消息管理</h1>
        <button class="btn-add-news" onclick="location.href='?inc=add_news'">+ 新增消息</button>
    </div>
    
    <!-- 消息列表 -->
    <?php 
    $all_news=$pdo->query("select * from news order by created_at desc")->fetchAll();
    
    if(count($all_news) > 0):
    ?>
    <table class="news-table">
        <thead>
            <tr>
                <th style="width: 60px;">消息ID</th>
                <th style="width: 200px;">標題</th>
                <th style="flex: 1;">內容預覽</th>
                <th style="width: 120px;">發布日期</th>
                <th style="width: 150px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($all_news as $idx => $news):?>
            <tr>
                <td class="news-id"><?= $idx + 1; ?></td>
                <td class="news-subject" style="width:20%"><?= htmlspecialchars($news['subject']); ?></td>
                <td class="news-preview" style="width:40%"><?= htmlspecialchars(mb_substr($news['content'], 0, 40)); ?>...</td>
                <td class="news-date" style="width:15%"><?= date("Y-m-d", strtotime($news['created_at'])); ?></td>
                <td  style="width:15%">
                    <div class="action-buttons">
                        <button class="btn-edit" onclick="location.href='?inc=edit_news&id=<?=$news['id'];?>'">編輯</button>
                        <button class="btn-delete" onclick="location.href='?inc=delete_news&id=<?=$news['id'];?>'">刪除</button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="empty-state">
        <p>📭 暫無消息</p>
        <p>點擊「新增消息」按鈕來建立第一條消息</p>
    </div>
    <?php endif; ?>
</div>