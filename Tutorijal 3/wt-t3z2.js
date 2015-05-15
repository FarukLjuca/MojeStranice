function foo () {
    document.write("<table><tr><th>X</th>");
    var i;
    for (i = 1; i <= 10; i++) {
        document.write("<th>" + i + "</th>");
    }
    for (i = 1; i <= 10; i++) {
        document.write("<tr><th>" + i + "</th>");
        var j;
        for (j = 1; j <= 10; j++) {
            document.write("<td>" + (i*j) + "</td>");
        }
        document.write("</tr>");
    }
    document.write("</table>");
}
onload = foo();