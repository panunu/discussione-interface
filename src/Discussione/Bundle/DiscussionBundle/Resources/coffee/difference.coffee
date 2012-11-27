difference = (element, data) ->
  data = data.summary.differences

  width = 1140
  height = 400

  x = d3.scale.linear().domain([0, data.length]).range([0, width])
  y = d3.scale.linear().domain([0, 1]).range([height, 0])

  line = d3.svg.line()
    .x((d) -> 10 + x(d.x))
    .y((d) -> y(d.y))
    .interpolate("basis")

  line2 = d3.svg.line()
    .x((d) -> 10 + x(d.x))
    .y((d) -> y(d.z))
    .interpolate("basis")

  vis = d3.select(element)
    .data([data])
    .append("svg")
    .attr("viewBox", "0 0 " + width + " " + height)
    .attr("preserveAspectRatio", "xMidYMid meet")
    .attr("class", "bubble")

  vis.append("svg:path")
    .attr("d", line2)
    .attr("fill", "none")
    .attr("stroke", "black")
    .attr("stroke-width", 50)
    .attr("opacity", 0.1)

  vis.append("svg:path")
    .attr("class", "line")
    .attr("d", line)
    .attr("fill", "none")
    .attr("stroke", "white")
    .attr("stroke-width", 3)

  vis.selectAll("circle.line")
    .data(data)
    .enter()
    .append("svg:circle")
    .attr("fill", (d) -> d3.interpolateRgb("crimson", "grey")(Math.random()))
    .attr("cx", (d) -> 10 + x(d.x))
    .attr("cy", (d) -> y(d.y))
    .attr("title", (d) -> d.author)
    .attr("r", 5)

(exports ? this).difference = difference