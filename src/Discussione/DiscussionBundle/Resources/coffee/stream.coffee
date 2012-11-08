stream = (element, data) ->
  n = 5
  m = 10

  stream_waves = (n, m) ->
    d3.range(n).map (i) ->
      d3.range(m).map((j) ->
        x = 20 * j / m - i / 3
        2 * x * Math.exp(-.5 * x)
      ).map stream_index

  stream_index = (d, i) ->
    { x: i, y: Math.max(0, d)}

  data0 = d3.layout.stack().offset("wiggle")(stream_waves(n, m))
  data1 = d3.layout.stack().offset("wiggle")(stream_waves(n, m))
  color = d3.interpolateRgb("black", "white")

  console.log(stream_waves(n, m))

  width = 500
  height = 500
  mx = m
  my = d3.max(data0.concat(data1), (d) ->
    d3.max(d, (d) -> d.y0 + d.y)
  )

  area = d3.svg.area()
    .x((d) -> d.x * width / mx)
    .y0((d) -> height - d.y0 * height / my)
    .y1((d) -> height - (d.y + d.y0) * height / my)

  vis = d3.select(element).append('svg')
    .attr('width', width)
    .attr('height', height)

  vis.selectAll("path")
    .data(data0)
    .enter().append("path")
    .attr("text-anchor", "middle")
    .text("WRYY")
    .style("fill", -> color(Math.random()))
    .attr("title", "test")
    .style("font-size", "24px")
    .attr("d", area)

  ###transition = ->
    d3.selectAll("path")
      .data(->
        d = data0
        data1 = data0
        data0 = d
        data0
      )
      .transition()
      .duration(2500)
      .attr('d', area)###

(exports ? this).stream = stream


###
var n = 20, // number of layers
2     m = 200, // number of samples per layer
3     data0 = d3.layout.stack().offset("wiggle")(stream_layers(n, m)),
4     data1 = d3.layout.stack().offset("wiggle")(stream_layers(n, m)),
5     color = d3.interpolateRgb("#aad", "#556");
6
7 var width = 960,
8     height = 500,
9     mx = m - 1,
10     my = d3.max(data0.concat(data1), function(d) {
  11       return d3.max(d, function(d) {
12         return d.y0 + d.y;
13       });
14     });
17     .x(function(d) { return d.x * width / mx; })
18     .y0(function(d) { return height - d.y0 * height / my; })
19     .y1(function(d) { return height - (d.y + d.y0) * height / my; });
20
21 var vis = d3.select("#chart")
22   .append("svg")
23     .attr("width", width)
24     .attr("height", height);
25
26 vis.selectAll("path")
27     .data(data0)
28   .enter().append("path")
29     .style("fill", function() { return color(Math.random()); })
30     .attr("d", area);
31
32 function transition() {
33   d3.selectAll("path")
34       .data(function() {
35         var d = data1;
  36         data1 = data0;
  37         return data0 = d;
38       })
39     .transition()
40       .duration(2500)
41       .attr("d", area);
42 }###