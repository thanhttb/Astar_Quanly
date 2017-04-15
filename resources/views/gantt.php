<script src="dhtmlxGantt/codebase/dhtmlxgantt.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="dhtmlxGantt/codebase/dhtmlxgantt.css" type="text/css" media="screen" title="no title" charset="utf-8">

<style type="text/css">
    html, body{ height:100%; padding:0px; margin:0px; overflow: hidden;}
</style>

<div id="gantt_here" style='width:100%; height:250px;'></div>

<script type="text/javascript">
    gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
    gantt.config.step = 1;
    gantt.config.scale_unit= "day";
    gantt.init("gantt_here", new Date(2010,7,1), new Date(2010,8,1));
    gantt.load("./gantt_data", "xml");

    var dp = new dataProcessor("./gantt_data");
    dp.init(gantt);
</script>