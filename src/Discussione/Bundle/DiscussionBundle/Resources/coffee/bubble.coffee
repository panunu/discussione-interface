bubble = (element, data) ->
  r = 1140

  format = d3.format("f")
  fill = d3.scale.ordinal().range(['white'])

  bubble = d3.layout.pack()
    .sort((a, b) -> b.value - a.value)
    .size([r, r])

  vis = d3.select(element).append("svg")
    .attr("viewBox", "0 0 " + r + " " + r)
    .attr("preserveAspectRatio", "xMidYMid meet")
    .attr("class", "bubble")

  data = {
    name: '',
    children: _.map data.summary.keyphrases, (frequency, keyphrase) ->
      'name': keyphrase, 'value': frequency
  }

  node = vis.selectAll("g.node")
    .data(bubble.nodes(data))
    .enter().append("g")
    .attr("class", "node")
    .attr("transform", (d) -> "translate(" + d.x + "," + d.y + ")")
    .style("opacity", (d) -> d.value + d.value / 2)

  node.append("circle")
    .attr("r", (d) -> d.r)
    .style("fill", (d) -> fill(d.name))
    .attr("title", (d) -> d.name)

  node.append("text")
    .attr("text-anchor", "middle")
    .attr("y", ".3em")
    .text((d) -> d.name.substring(0, d.r / 3))
    .style("font-size", "24px")
    .style("font-size", (d) -> (d.r * 2) / @getComputedTextLength() * 20)

(exports ? this).bubble = bubble