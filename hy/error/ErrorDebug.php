<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/27
 * Time: 下午5:36
 */
namespace hy\error;

use hy\utils\Config;

class ErrorDebug {

    static public function html($type, $echoStr) {
        $debug = Config::get("application.main", "debug");
        if ($debug) {
            $html =
<<<EOF
<script>
    window.onload = function() {
        let div = document.createElement("div");
        document.body.appendChild(div);
        let html = `
            <div id="errorMain" style="display:flex;flex-direction:column;align-items:center;width:100%;height:30%;background:#000;position:fixed;left:0;bottom:0;z-index:999;">
                <div id="close" style="cursor:pointer;width:20px;height:20px;line-height:20px;text-align:center;border-radius:50%;position:absolute;right:0;top:0;background:#fff;color:red;">X</div>
                <div style="width:98%;color:red;font-size:13px;margin-top:10px;">
                错误类型:${type}
                </div>
                <div style="width:98%;color:red;font-size:13px;margin-top:10px;">
                错误信息:${echoStr}
                </div>
            </div>`;
        div.innerHTML = html;
        document.querySelector("#close").addEventListener("click", function(){
            document.querySelector("#errorMain").style.display = "none";
        });
    };
</script>
EOF;
            echo $html;
        }
    }
}