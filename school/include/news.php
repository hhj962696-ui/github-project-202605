<H1>消息管理</H1>
<button onclick="location.href='?inc=add_news'">新增消息</button>
<!-- 消息列表 -->
<table>
    <thead>
        <tr>
            <th>消息ID</th>
            <th>標題</th>
            <th>內容</th>
            <th>發布日期</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <!-- 這裡將動態生成消息列表 -->
        <tr>
            <td>1</td>
            <td>開學典禮</td>
            <td>開學典禮將於9月1日舉行，請全體師生準時參加。</td>
            <td>2024-08-25</td>
            <td><button>編輯</button><button>刪除</button></td>
        </tr>
        <!-- 更多消息 -->
    </tbody>
</table>