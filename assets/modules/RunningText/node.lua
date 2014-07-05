gl.setup(1280, 64)

util.auto_loader(_G)

function feeder()
    local feed_text = {}

    feed_text = {"Running text presentation module - Present your text information in this section - Support up to 256 Characters - Design by ProDesign - Power by ProIT",}    return feed_text
end

text = util.running_text{
    font = ubuntuc;
    size = 50;
    speed = 50;
    color = {1,1,1,1};
    generator = util.generator(feeder)
}

function node.render()
    local alpha = 0.7
    gl.clear(0, 0, 1, alpha) -- blue
    text:draw(HEIGHT-58)
end
