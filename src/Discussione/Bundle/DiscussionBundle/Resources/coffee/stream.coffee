stream = (element, data) ->
  m = _.first(_.toArray(data.summary.stream)).length

  data = d3.layout.stack().offset("wiggle")(_.toArray(data.summary.stream))
  color = d3.interpolateRgb("black", "white")

  width = 1140
  height = 600

  mx = m - 1
  my = d3.max(data, (d) ->
    d3.max(d, (d) ->
      d.y0 + d.y
    )
  )

  area = d3.svg.area()
    .x((d) -> d.x * width / mx)
    .y0((d) -> height - d.y0 * height / my)
    .y1((d) -> height - (d.y + d.y0) * height / my)
    .interpolate("monotone")

  vis = d3.select(element).append('svg')
    .attr("viewBox", "0 0 " + width + " " + height)
    .attr("preserveAspectRatio", "xMidYMid meet")

  vis.selectAll("path")
    .data(data)
    .enter().append("path")
    .style("fill", -> color(Math.random()))
    .attr("d", area)
    .attr("title", (d, i) -> _.first(d).name)

(exports ? this).stream = stream
