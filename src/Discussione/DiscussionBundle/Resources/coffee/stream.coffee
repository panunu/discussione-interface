stream = (element, data) ->
  n = 10
  m = _.first(_.toArray(data.summary.stream)).length

  data = d3.layout.stack().offset("wiggle")(_.toArray(data.summary.stream))
  color = d3.interpolateRgb("black", "white")

  width = 860
  height = 500
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

  vis = d3.select(element).append('svg')

  vis.selectAll("path")
    .data(data)
    .enter().append("path")
    .style("fill", -> color(Math.random()))
    .attr("d", area)
    .attr("title", (d, i) -> _.first(d).name)

(exports ? this).stream = stream
