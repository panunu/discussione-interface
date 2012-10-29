visualizer = (url) ->
  r = 800
  format = d3.format("f")
  fill = d3.scale.ordinal().range(['white'])

  bubble = d3.layout.pack()
    .sort(null)
    .size([r, r])
    .padding(5)

  vis = d3.select("#bubble-chart").append("svg")
    .attr("viewBox", "0 0 " + r + " " + r)
    .attr("preserveAspectRatio", "xMinYMin meet")
    .attr("class", "bubble")

  d3.json url, (json) ->
    keyphrases = json.summary.keyphrases
    data = {
      name: '',
      children: _.map keyphrases, (frequency, keyphrase) -> 'name': keyphrase, 'value': frequency
    }

    node = vis.selectAll("g.node")
      .data(bubble.nodes(data))
      .enter().append("g")
      .attr("class", "node")
      .attr("transform", (d) -> "translate(" + d.x + "," + d.y + ")")

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