<div class="control-group">
    <div>
        <h4 align='left'><font color="red">排期总体概况：</font></h4>
    </div>
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th>日期</th>
        <th>排期总数</th>
        <th>停售排期数</th>
        <th>停售比例</th>

    </tr>
    </thead>
    <tbody id="divAjax">
    <?php if(!empty($schedule_list)){
        foreach ($schedule_list as $schedule){
            if($schedule){ ?>
                <tr>
                    <td><a href='#'><?php echo $schedule['date'];?></a></td>
                    <td><?php echo $schedule['num'];?></td>
                    <td><?php echo $schedule['stop_num'];?></td>
                    <td><?php echo round(($schedule['stop_num']/$schedule['num'])*100).'%';?></td>
                </tr>

            <?php }}}?>
    <tr>
        <td>合计：</td>
        <td><?php echo $total_num;?></td>
        <td><?php echo $stop_num;?></td>
        <td><?php echo round(($stop_num/$total_num)*100).'%';?></td>
    </tr>
    </tbody>
</table>
<div class="control-group">
    <div>
        <h4 align='left'><font color="red">停售排期TOP10(今日)：</font></h4>
    </div>
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th>影院编号</th>
        <th>影院名称</th>
        <th>排期总数</th>
        <th>停售排期数</th>
        <th>停售比例</th>
    </tr>
    </thead>
    <tbody id="divAjax">
    <?php if(!empty($top_schedule_list)){
        foreach ($top_schedule_list as $top_schedule){
            if($top_schedule){ ?>
                <tr>
                    <td><?php echo $top_schedule['cinema_no'];?></td>
                    <td><?php echo $top_schedule['cinema_name'];?></td>
                    <td><?php echo $top_schedule['total_num'];?></td>
                    <td><?php echo $top_schedule['top_stop_num'];?></td>
                    <td><?php echo round(($top_schedule['top_stop_num']/$top_schedule['total_num'])*100).'%';?></td>
                </tr>
            <?php }}}?>
    </tbody>
</table>
 