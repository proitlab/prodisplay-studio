gl.setup(172, 64)
util.auto_loader(_G)

local base_time = N.base_time or 0
-- local font = resource.load_font("Ubuntu-C.ttf")
local font = resource.load_font("DS-DIGIT.TTF")

util.data_mapper{
    ["clock/set"] = function(time)
        base_time = tonumber(time) - sys.now()
        N.base_time = base_time
    end;
}


-- local bg

function node.render()
    gl.clear(0,0,0,0.7)
    local time = base_time + sys.now()

    local hour = math.floor((time / 3600) % 24)
    local minute = math.floor(time % 3600 / 60)
    local second = math.floor(time % 60)

    if hour < 10 then
	fullhour = "0" .. hour
    else
	fullhour = hour
    end
    if minute < 10 then
	fullminute = "0" .. minute
    else
	fullminute = minute
    end
    if second < 10 then
	fullsecond = "0" .. second
    else
	fullsecond = second
    end

    local line = fullhour .. ":" .. fullminute .. ":" .. fullsecond

    local fake_second = second * 1.05
    if fake_second >= 60 then
        fake_second = 60
    end

    local size = 48
    font:write(3, 10, line, size, 0, 1, 0, 1)
end
