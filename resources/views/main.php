<style>

    .navigation {
        background: #ffffff;
        width: 1000px;
        display: table;
        margin-left: auto;
        margin-right: auto;
        clear: both;
    }

    .nav_table {
        padding: 30px 0px;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        border-width: 0px;
    }

    .nav_table td{
        border-width: 0px;
        padding:11px;
    }
    .nav_table tr{
        background: #f3f3f3;
    }
    .nav_table tr:nth-child(2n){
        background: white;
    }

    .nav_table tr td:nth-child(1){
        width: 20px;
    }

    .nav_table a{
        font-size:16px;
        color: #0F8192;
        text-decoration: none;
    }

    .nav_folder_img {
        background: url(../public/imgs/folder.jpg);
        width: 32px;
        height: 29px;
    }

</style>

<div class="navigation">
    <table class="nav_table">
        <tr>
            <td>
                <a href="./grid">
                    <div class="nav_folder_img"></div>
                </a>
            </td>
            <td>
                <a href="./grid">Grid</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="./scheduler">
                    <div class="nav_folder_img"></div>
                </a>
            </td>
            <td>
                <a href="./scheduler">Scheduler</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="./gantt">
                    <div class="nav_folder_img"></div>
                </a>
            </td>
            <td>
                <a href="./gantt">Gantt</a>
            </td>
        </tr>
    </table>
</div>