class PubSub {
    events = {};

    subscribe = (event, callback) => {
        this.events[event] = this.events[event] || [];
        this.events[event].push(callback);
    };

    trigger = (event, data) => {
        if (!this.events[event]) {
            return;
        }

        for (let callback of this.events[event]) {
            if (typeof callback === 'function') {
                callback(data);
            }
        }
    };
}