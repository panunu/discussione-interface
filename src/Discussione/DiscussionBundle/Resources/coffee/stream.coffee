stream = (element, data) ->
  n = 20
  m = 200


  stream_index = (d, i) ->
    { x: i, y: Math.max(0, d)}

  stream_waves = (n, m) ->
    return d3.range(n).map (i) ->
      return d3.range(m).map((j) ->
        x = 5 * j / m - i / 3
        return 2 * x * Math.exp(-0.5 * x)
      ).map stream_index

  n = 10
  m = _.first(_.toArray(data.summary.stream)).length

  console.log data.summary.stream

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
    .attr("d", area)
    .attr("title", (d, i) -> d[i].name)
    .style("fill", -> color(Math.random()))

(exports ? this).stream = stream
